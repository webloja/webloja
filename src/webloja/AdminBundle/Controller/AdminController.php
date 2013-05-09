<?php

namespace webloja\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Entity\Usuario;
use webloja\AdminBundle\Form\Type\AddNewUserType;
use webloja\WeblojaBundle\Repository\MenuRepository;

class AdminController extends Controller
{
    public function indexAction($id_interno){
       
        /**
         * codigo referente ao controle de sessão da pagina
         * este código deve ser colocado em todos os controllers
         * nos metodos que reenderizam formulários
         */
        $session = $this->getRequest()->getSession();
        if(!$session->get('id_user')){
            
             $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
             return $this->redirect($this->generateUrl('logout'));
        }
        /*******************************************************/
        
        /**
         * Condigo referente a montagem do título da pagina
         * precisa ser colocado em toda página que gera formulário
         * ou que tenha saída para template
         */
        if($id_interno!=null){
             $this->conn = $this->get('database_connection');
             MenuRepository::getIdInterno($id_interno,$this->conn,$session);
        }
        
        $usuario = new Usuario();
       
        
        $form = $this->createForm(new AddNewUserType(),$usuario);
        
        $requisicao = $this->getRequest();
        
        if ($requisicao->isMethod('POST')) {
            $form->bind($requisicao);

            if ($form->isValid()) {

                //$user = $form->getData();
                
                if($usuario->getId()==null){
                    $usuario->setLocal($session->get('local'));
                    //$usuario->setDataCriacao(date('Y-m-d')); 
                }
                
                if($usuario->getSenha() == $usuario->getConfirmeSenha()){
                    $usuario->setSenha(base64_encode($usuario->getSenha()));
                }else{
                    $this->get('session')->getFlashBag()->add('notice_erro', '* Os campos Senha e Confirme a Senha precisam ser iguais!');
                    return $this->render('AdminBundle:Admin:addUsuarioNovo.html.twig', array('form' => $form->createView(),'id_interno' => $id_interno));
                }
                $usuario->setAtivo(1);
                echo "<pre>";
                print_r($usuario);
                echo "</pre>";
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($usuario);
//                $em->flush();
//
//                $this->get('session')->getFlashBag()->add('notice_sucesso', 'Usuário criado com sucesso!');
//
//               return $this->render('AdminBundle:Admin:addUsuarioNovo.html.twig', array('form' => $form->createView(),'id_interno' => $id_interno));
            }
        }

        return $this->render('AdminBundle:Admin:addUsuarioNovo.html.twig', array(
                    'form' => $form->createView(),
        ));
        
    }
}
