<?php

namespace webloja\WeblojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\HomeRepository;

class HomeController extends Controller
{
    private $conn;
    
    public function indexAction(){
        
        
        $this->conn = $this->get('database_connection');
        
        $session = $this->getRequest()->getSession();
        $session->remove('id_interno');
        $loja = $session->get('local');
        
        
        if(!$session->get('id_user')){
            
             $this->get('session')->getFlashBag()->add('notice', "Efetue o login para entrar no sistema!");
             return $this->logout();
        }
        
        $homedb = new HomeRepository();
        
        
        $pMarketing = $homedb->getMarketing($loja,$this->conn);
        $pMerchandising = $homedb->getMerchandising($loja,$this->conn);
        $pNoticiaDol = $homedb->getNoticiaDol($loja,$this->conn);
        $pNotificacaoGeral = $homedb->getNotificacaoGeral($loja,$this->conn);
        $pBanner = $homedb->getBanner($this->conn,1);
        
        return $this->render('WeblojaBundle:Home:principal.html.twig', array('objMarketing' => $pMarketing,
            'objMerchandising' => $pMerchandising,'objNoticiaDol' => $pNoticiaDol ,
            'objNotificacao' => $pNotificacaoGeral,'objBanner' => $pBanner));
    }
    
    public function logoutAction(){
        $session = $this->getRequest()->getSession();
        $session->clear();
        return $this->redirect($this->generateUrl('login'));
    }
    
    private function logout(){
        return $this->redirect($this->generateUrl('logout'));
    }
}
