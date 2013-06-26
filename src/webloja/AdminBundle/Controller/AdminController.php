<?php

namespace webloja\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Entity\Usuario;
use webloja\AdminBundle\Form\Type\AddNewUserType;
use webloja\WeblojaBundle\Repository\MenuRepository;
use webloja\AdminBundle\Entity\CFUsuario;
use webloja\AdminBundle\Form\Type\AddCFUserProntuarioType;
use webloja\AdminBundle\Form\Type\UpdateSenhaUsuarioType;
use webloja\LIB\TRfc;
use Symfony\Component\HttpFoundation\Response;
use webloja\AdminBundle\Form\Type\UpdateCFUserProntuarioType;
use webloja\AdminBundle\Form\Type\ResetSenhaProntuarioType;
use webloja\AdminBundle\Form\Type\UpdateLojaProntuarioType;
use webloja\AdminBundle\Form\Type\NovaLojaProntuarioType;

class AdminController extends Controller {

  public function indexAction($id_interno) {

    /**
     * codigo referente ao controle de sessÃ£o da pagina
     * este cÃ³digo deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulÃ¡rios
     */
    $session = $this->getRequest()->getSession();
    if (!$session->get('id_user')) {

      $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
      return $this->redirect($this->generateUrl('logout'));
    }
    /*     * **************************************************** */

    /**
     * Condigo referente a montagem do tÃ­tulo da pagina
     * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
     * ou que tenha saÃ­da para template
     */
    if ($id_interno != null) {
      MenuRepository::getIdInterno($id_interno, $session);
    }

    $usuario = new Usuario();


    $form = $this->createForm(new AddNewUserType(), $usuario);

    $requisicao = $this->getRequest();

    if ($requisicao->isMethod('POST')) {
      $form->bind($requisicao);

      if ($form->isValid()) {

        //$user = $form->getData();

        if ($usuario->getId() == null) {
          $usuario->setLocal($session->get('local'));
          /**
           * Se feznecessario o uso da clase DateTime, pois mesmo mapeando o campo da entity com o mesmo tipo do 
           * banco de dados, estava dando erro de formataÃ§Ã£o no momento de inserir a data.
           */
          $usuario->setDataCriacao(new \DateTime(date('Y-m-d')));
        }

        if ($usuario->getSenha() == $usuario->getConfirmeSenha()) {
          $usuario->setSenha(base64_encode($usuario->getSenha()));
        } else {
          $this->get('session')->getFlashBag()->add('notice_erro', '* Os campos Senha e Confirme a Senha precisam ser iguais!');
          return $this->render('AdminBundle:Admin:addUsuarioNovo.html.twig', array('form' => $form->createView(), 'id_interno' => $id_interno));
        }
        $usuario->setIdPerfil($usuario->getIdPerfil()->getId());
        $usuario->setAtivo(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();
//
        $this->get('session')->getFlashBag()->add('notice_sucesso', 'Usuário criado com sucesso!');

        return $this->render('AdminBundle:Admin:addUsuarioNovo.html.twig', array('form' => $form->createView(), 'id_interno' => $id_interno));
      }
    }

    return $this->render('AdminBundle:Admin:addUsuarioNovo.html.twig', array(
                'form' => $form->createView(),
    ));
  }

  public function newUserProntuarioAction($id_interno) {

    /**
     * codigo referente ao controle de sessÃ£o da pagina
     * este cÃ³digo deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulÃ¡rios
     */
    $session = $this->getRequest()->getSession();
    if (!$session->get('id_user')) {

      $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
      return $this->redirect($this->generateUrl('logout'));
    }
    /*     * **************************************************** */

    /**
     * Condigo referente a montagem do tÃ­tulo da pagina
     * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
     * ou que tenha saÃ­da para template
     */
    if ($id_interno != null) {
      MenuRepository::getIdInterno($id_interno, $session);
    }

    $cfUsuario = new CFUsuario();

    $form = $this->createForm(new AddCFUserProntuarioType(), $cfUsuario);

    $request = $this->getRequest();

    if ($request->isMethod('POST')) {
      $form->bind($request);

      if ($form->isValid()) {

        /**
         * Verifica a existencia do prontuario no webloja
         */
        $repository = $this->getDoctrine()
                ->getRepository('AdminBundle:CFUsuario')
                ->findOneBy(array('prontuario' => $cfUsuario->getProntuario()));

        if ($repository) {

          $this->get('session')->getFlashBag()->add('notice_erro', "Esse prontuário já está cadastro!");
          return $this->render('AdminBundle:Admin:addCFUserProntuario.html.twig', array('form' => $form->createView(), 'id_interno' => $id_interno));
        } else {
          /**
           * se não existir cadastra no banco do webloja
           */
          $cfUsuario->setLoja($session->get('local'));
          $cfUsuario->setSenha(base64_encode($cfUsuario->getSenha()));
          $em = $this->getDoctrine()->getManager();
          $em->persist($cfUsuario);
          $em->flush();

          $this->get('session')->getFlashBag()->add('notice_sucesso', "Cadastro realizado com sucesso!");
          return $this->render('AdminBundle:Admin:addCFUserProntuario.html.twig', array('form' => $form->createView(), 'id_interno' => $id_interno));
        }
      }
    }

    return $this->render('AdminBundle:Admin:addCFUserProntuario.html.twig', array(
                'form' => $form->createView(),
    ));
  }

  public function verificaProntuarioAction() {

    try {

      $request = $this->getRequest();
      $prontuario = $request->get("prontuario");
      /**
       * UTILIZANDO A CLASSE RFC PARA TRABALHAR COM O SAP
       */
      $rfc = new TRfc();
      $rfc->open();
      $rfc->getZCOM("ZRH_CONSULTA_DE_ASSOCIADO");
      $rfc->import("P_PERNR", $prontuario);
      $rfc->rfc_executa_rfc();
      /**
       * Recuperar dados do export
       */
      $E_RETORNO = $rfc->export("E_RETORNO");

      /**
       * FIM
       */
      if (substr($E_RETORNO, 0, 1) == "R") {

        $retorno = "R";
      } else {
        //8
        $prontuario = substr($E_RETORNO, 0, 8);
        //4
        $subarea = substr($E_RETORNO, 8, 4);
        //1
        $status = substr($E_RETORNO, 12, 1);
        //40
        $nome = substr($E_RETORNO, 13, 40);

        $retorno = $prontuario . ";" . $status . ";" . $nome;
      }
      
      /**
       * CODIGO PARA SER USADO QUANDO PRECISAR DE RFC E HOUVER REDIRECIONAMENTO DE PAGINA
       * MOSTRA O DEBUG DA RFC. 
       */
      //$this->get('session')->getFlashBag()->add('debug_rfc', $obj->debugRFC($obj));
      //return $this->redirect($this->generateUrl('AdminCFUserProntuario',array('id_interno'=>$session->get('id_interno'))));
      //FIM DO CODIGO
      $rfc->rfcClose();
      return new Response($retorno);
      
    } catch (\Exception $e) {
      return new Response($e->getMessage());
    }
  }

  public function updateSenhaUsuarioAction($id_interno) {

    /**
     * codigo referente ao controle de sessÃ£o da pagina
     * este cÃ³digo deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulÃ¡rios
     */
    $session = $this->getRequest()->getSession();
    if (!$session->get('id_user')) {

      $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
      return $this->redirect($this->generateUrl('logout'));
    }
    /*     * **************************************************** */

    /**
     * Condigo referente a montagem do tÃ­tulo da pagina
     * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
     * ou que tenha saÃ­da para template
     */
    if ($id_interno != null) {
      MenuRepository::getIdInterno($id_interno, $session);
    }

    $usuario = new Usuario();


    $form = $this->createForm(new UpdateSenhaUsuarioType(), $usuario);

    $request = $this->getRequest();

    if ($request->isMethod('POST')) {
      $form->bind($request);

      if ($form->isValid()) {

        try {
          /**
           * pegar dados do formulário que não são relacionados ao Entity
           */
          $dados = $form->getData();

          $id_user = $session->get("id_user");

          $em = $this->getDoctrine()->getManager();
          $usuario = $em->getRepository('WeblojaBundle:Usuario')->find($id_user);

          if (base64_encode($dados->getSenha()) != $usuario->getSenha()) {

            /**
             * criando exception
             */
            throw $this->createNotFoundException('Informe sua senha corretamente !');
          } else {

            $novaSenha = $_POST['updateSenhaUser']['senhaNova'];
            $usuario->setSenha(base64_encode($novaSenha));
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice_sucesso', "Senha alterada com Sucesso!");
            return $this->render('AdminBundle:Admin:updateSenhaUsuario.html.twig', array(
                        'form' => $form->createView(), 'id_interno' => $id_interno));
          }
        } catch (\Exception $exc) {

          if ($exc) {
            $this->get('session')->getFlashBag()->add('notice_erro', $exc->getMessage());
          } else {
            $this->get('session')->getFlashBag()->add('notice_erro', "Falha ao tentar alterar senha!");
          }
          return $this->render('AdminBundle:Admin:updateSenhaUsuario.html.twig', array(
                      'form' => $form->createView(), 'id_interno' => $id_interno));
        }
      }
    }

    return $this->render('AdminBundle:Admin:updateSenhaUsuario.html.twig', array(
                'form' => $form->createView(),
    ));
  }

  public function updateUserProntuarioAction($id_interno) {

    /**
     * codigo referente ao controle de sessÃ£o da pagina
     * este cÃ³digo deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulÃ¡rios
     */
    $session = $this->getRequest()->getSession();
    if (!$session->get('id_user')) {

      $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
      return $this->redirect($this->generateUrl('logout'));
    }
    /*     * **************************************************** */

    /**
     * Condigo referente a montagem do tÃ­tulo da pagina
     * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
     * ou que tenha saÃ­da para template
     */
    if ($id_interno != null) {
      MenuRepository::getIdInterno($id_interno, $session);
    }

    $cfUsuario = new CFUsuario();

    $form = $this->createForm(new UpdateCFUserProntuarioType(), $cfUsuario);

    $request = $this->getRequest();

    if ($request->isMethod('POST')) {
      $form->bind($request);

      if ($form->isValid()) {

        try {

          $senhaNova = $_POST['updateCFUserProntuario']['senhaNova'];

          $session = $this->getRequest()->getSession();

          $em = $this->getDoctrine()->getManager();
          $cfUsuario = $em->getRepository('AdminBundle:CFUsuario')->findOneBy(array('prontuario' => $cfUsuario->getProntuario(),
              'senha' => base64_encode($cfUsuario->getSenha())));

          if ($cfUsuario != null) {

            if ($cfUsuario->getLoja() != $session->get('local')) {

              throw $this->createNotFoundException('Não possível alterar a senha por essa loja !');
            } else {

              $cfUsuario->setSenha(base64_encode($senhaNova));
              $em->flush();

              $this->get('session')->getFlashBag()->add('notice_sucesso', "Senha alterada com Sucesso!");

              return $this->render('AdminBundle:Admin:updateSenhaProntuario.html.twig', array(
                          'form' => $form->createView(), 'id_interno' => $id_interno));
            }
          } else {

            throw $this->createNotFoundException('O prontuário ou a senha atual não conferem !');
          }
        } catch (\Exception $exc) {
          if ($exc) {
            $this->get('session')->getFlashBag()->add('notice_erro', $exc->getMessage());
          } else {
            $this->get('session')->getFlashBag()->add('notice_erro', "Falha ao tentar alterar senha!");
          }
          return $this->render('AdminBundle:Admin:updateSenhaProntuario.html.twig', array(
                      'form' => $form->createView(), 'id_interno' => $id_interno));
        }
      }
    }

    return $this->render('AdminBundle:Admin:updateSenhaProntuario.html.twig', array(
                'form' => $form->createView()
    ));
  }

  public function resetSenhaProntuarioAction($id_interno) {
    /**
     * codigo referente ao controle de sessÃ£o da pagina
     * este cÃ³digo deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulÃ¡rios
     */
    $session = $this->getRequest()->getSession();
    if (!$session->get('id_user')) {

      $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
      return $this->redirect($this->generateUrl('logout'));
    }
    /*     * **************************************************** */

    /**
     * Condigo referente a montagem do tÃ­tulo da pagina
     * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
     * ou que tenha saÃ­da para template
     */
    if ($id_interno != null) {
      MenuRepository::getIdInterno($id_interno, $session);
    }

    $cfUsuario = new CFUsuario();

    $form = $this->createForm(new ResetSenhaProntuarioType(), $cfUsuario);

    $request = $this->getRequest();

    if ($request->isMethod('POST')) {

      try {
        $em = $this->getDoctrine()->getManager();
        $cfUsuario = $em->getRepository('AdminBundle:CFUsuario')
                ->findOneBy(array('prontuario' => $_POST['resetSenhaProntuario']['prontuario'],
            'loja' => $session->get('local')));
        if ($cfUsuario != null) {

          $nSenha = "lasa" . date('Y');
          $cfUsuario->setSenha(base64_encode($nSenha));
          $em->flush();

          $this->get('session')->getFlashBag()->add('notice_sucesso', 'Prontuário resetado com sucesso. A nova senha é ' . $nSenha . ' !');
          return $this->render('AdminBundle:Admin:resetSenhaProntuario.html.twig', array('form' => $form->createView()));
        } else {
          if ($session->get('id_perfil') == 62) {
            throw $this->createNotFoundException("Loja ou prontuário não existe!");
          } else {
            throw $this->createNotFoundException("Prontuário não existe!");
          }
        }
      } catch (\Exception $exc) {

        $this->get('session')->getFlashBag()->add('notice_erro', $exc->getMessage());
        return $this->render('AdminBundle:Admin:resetSenhaProntuario.html.twig', array('form' => $form->createView()));
      }
    }

    return $this->render('AdminBundle:Admin:resetSenhaProntuario.html.twig', array('form' => $form->createView()));
  }

  public function updateLojaProntuarioAction($id_interno) {
    /**
     * codigo referente ao controle de sessÃ£o da pagina
     * este cÃ³digo deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulÃ¡rios
     */
    $session = $this->getRequest()->getSession();
    if (!$session->get('id_user')) {

      $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
      return $this->redirect($this->generateUrl('logout'));
    }
    /*     * **************************************************** */

    /**
     * Condigo referente a montagem do tÃ­tulo da pagina
     * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
     * ou que tenha saÃ­da para template
     */
    if ($id_interno != null) {
      MenuRepository::getIdInterno($id_interno, $session);
    }

    $cfUsuario = new CFUsuario();

    $form = $this->createForm(new UpdateLojaProntuarioType(), $cfUsuario);

    $request = $this->getRequest();

    if ($request->isMethod('POST')) {

      $em = $this->getDoctrine()->getManager();
      $cfUsuario = $em->getRepository('AdminBundle:CFUsuario')
              ->findOneBy(array('prontuario' => $_POST["updateLojaProntuario"]["prontuario"]));
      if ($cfUsuario != null) {

        $session->set("prontuario", $_POST["updateLojaProntuario"]["prontuario"]);

        return $this->redirect($this->generateUrl('NovaLojaProntuario', array('id_interno' => $id_interno)));
      } else {

        $this->get('session')->getFlashBag()->add('notice_erro', "Prontuario inexistente...!");
        return $this->render('AdminBundle:Admin:updateLojaProntuario.html.twig', array('form' => $form->createView()));
      }
    }

    return $this->render('AdminBundle:Admin:updateLojaProntuario.html.twig', array('form' => $form->createView()));
  }

  public function novaLojaProntuarioAction($id_interno) {

    /**
     * codigo referente ao controle de sessÃ£o da pagina
     * este cÃ³digo deve ser colocado em todos os controllers
     * nos metodos que reenderizam formulÃ¡rios
     */
    $session = $this->getRequest()->getSession();

    if (!$session->get('id_user')) {

      $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
      return $this->redirect($this->generateUrl('logout'));
    }
    /*     * **************************************************** */

    /**
     * Condigo referente a montagem do tÃ­tulo da pagina
     * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
     * ou que tenha saÃ­da para template
     */
    if ($id_interno != null) {
      MenuRepository::getIdInterno($id_interno, $session);
    }

    $cfUsuarior = new CFUsuario();

    $request = $this->getRequest();

    $em = $this->getDoctrine()->getManager();
    $cfUsuarior = $em->getRepository('AdminBundle:CFUsuario')
            ->findOneBy(array('prontuario' => $session->get('prontuario')));

    $form = $this->createForm(new NovaLojaProntuarioType(), $cfUsuarior);

    if ($request->isMethod('POST')) {

      $form->bind($request);

      if ($form->isValid()) {
        try {

          $em = $this->getDoctrine()->getManager();
          $cfUsuario = $em->getRepository('AdminBundle:CFUsuario')
                  ->find($cfUsuarior->getId());

          $cfUsuario->setLoja($_POST['novaLojaProntuario']['lojaDestino']);
          $em->flush();


          $cfUsuarior = $em->getRepository('AdminBundle:CFUsuario')
                  ->find($cfUsuarior->getId());
          $form = $this->createForm(new NovaLojaProntuarioType(), $cfUsuarior);

          $this->get('session')->getFlashBag()->add('notice_sucesso', "Dados alterados com sucesso !");
          return $this->render('AdminBundle:Admin:novaLojaProntuario.html.twig', array('formNovaLoja' => $form->createView()));
        } catch (\Exception $exc) {

          $this->get('session')->getFlashBag()->add('notice_erro', "Erro ao realizar alteração dos dados !");
          return $this->render('AdminBundle:Admin:novaLojaProntuario.html.twig', array('formNovaLoja' => $form->createView()));
        }
      }
    }

    return $this->render('AdminBundle:Admin:novaLojaProntuario.html.twig', array('formNovaLoja' => $form->createView()));
  }

}
