<?php

namespace webloja\ChamadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\ChamadosBundle\Form\Type\AddLinkOcorrenciaType;
use webloja\WeblojaBundle\Repository\MenuRepository;

class ChamadosController extends Controller { 

    public function indexAction($id_interno=null) {
        
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
//             $this->conn = $this->get('database_connection');
             MenuRepository::getIdInterno($id_interno,$session);
        }
        
        $form = $this->createForm(new AddLinkOcorrenciaType());

        $requisicao = $this->getRequest();

        if ($requisicao->isMethod('POST')) {
            $form->bind($requisicao);
            if ($form->isValid()) {

                try {

                    $form->getData();
                    
                } catch (\Exception $e) {
                    
                }
            }
        }

        return $this->render("ChamadosBundle:Chamados:index.html.twig", array(
                    'form' => $form->createView()));
    }

    public function moduloAction() {

        $requisicao = $this->getRequest();
        $processo_id = $requisicao->get('processo_id');

        $repository = $this->getDoctrine()
                ->getRepository('ChamadosBundle:AberturaChamadoSubprocesso');

        $query = $repository->createQueryBuilder('sp')
                ->where('sp.idProcesso = :processo_id')
                ->setParameter('processo_id', $processo_id)
                ->orderBy('sp.descricao', 'ASC')
                ->getQuery();

        $modulos = $query->getResult();

        return $this->render("ChamadosBundle:Chamados:optionModulo.html.twig", array(
                    'modulos' => $modulos));
    }
    
    public function linkAction() {

        $requisicao = $this->getRequest();
        $modulo_id= $requisicao->get('modulo_id');

        $repository = $this->getDoctrine()
                ->getRepository('ChamadosBundle:AberturaChamadoLink');

        $query = $repository->createQueryBuilder('acl')
                ->where('acl.idSubprocesso = :modulo_id')
                ->setParameter('modulo_id', $modulo_id)
                ->orderBy('acl.caminho', 'ASC')
                ->getQuery();

        $links = $query->getResult();

        return $this->render("ChamadosBundle:Chamados:optionLink.html.twig", array(
                    'links' => $links));
    }
    
    public function novoAction(){
        
         return $this->render("ChamadosBundle:Chamados:chamadoNovo.html.twig",array(
                    'link' => $_POST['addLinkOcorrencia']['link']));
    }
    
     public function listarAction($id_interno=null){
        
         $session = $this->getRequest()->getSession();
         if($id_interno!=null){
//             $this->conn = $this->get('database_connection');
             MenuRepository::getIdInterno($id_interno,$session);
         }
         return $this->render("ChamadosBundle:Chamados:chamadoListar.html.twig");
    }

}
