<?php

namespace webloja\ChamadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\ChamadosBundle\Form\Type\AddLinkOcorrenciaType;
use webloja\WeblojaBundle\Repository\MenuRepository;

class ChamadosController extends Controller {

    public function indexAction($id_interno) {
        
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
         * Condigo referente ao titulo de cada pagina
         */
        $this->conn = $this->get('database_connection');
        $rMenuInterno = MenuRepository::getIdInterno($id_interno,$this->conn);
        $session->set('id_interno', $rMenuInterno[0]['id_interno']);
        $session->set('menu', $rMenuInterno[0]['menu']);
        $session->set('titulo', $rMenuInterno[0]['titulo']);
        /********************************************************/
        
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

}
