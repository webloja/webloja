<?php

namespace webloja\WeblojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\MenuRepository;

class MenuController extends Controller
{
    private $conn;
    
    public function menuAction(){
        $this->MenuHtml();
        
        $this->conn = $this->get('database_connection');
        
        $session = $this->getRequest()->getSession();
        $id_perfil = $session->get('id_perfil');
        
        $rMenu = MenuRepository::getMenu($id_perfil, $this->conn);
        
        return $this->render("::menuNav.html.twig",array('objMenu'=>$rMenu));
    }
    
    public function subMenuAction($id_departamento){
        
        $this->conn = $this->get('database_connection');
        
        $session = $this->getRequest()->getSession();
        $id_perfil = $session->get('id_perfil');
        
        $subMenu = MenuRepository::getSubMenu($id_departamento, $id_perfil, $this->conn);
        
        return $this->render("::subMenu.html.twig",array('objSubMenu'=>$subMenu));
    }
    
     public function subMenuInternoAction($id_menu){
        
        $this->conn = $this->get('database_connection');
        
        $subMenuInterno = MenuRepository::getSubMenuInterno($id_menu, $this->conn);
        
//        $this->MenuHtml();
        
        return $this->render("::subMenuInterno.html.twig",array('objSubMenuInterno'=>$subMenuInterno));
        
    }
    
//    public function duplicaMenu(){
//        $origem = "C:\\wamp\\www\\webloja\\src\\webloja\\WeblojaBundle\\Resources\\views\\Home\\principal.html.twig";
//        $content=file_get_contents($origem); 
//        $destino =  "C:\\wamp\\www\\webloja\\app\\cache\\teste.html.twig";
//        file_put_contents($destino, $content);
// 
//        //$destino =  "C:\\wamp\\www\\webloja\\app\\cache\\menuNavCache.html.twig";       
//        //copy($origem , $destino);
//    }
    
    public function MenuHtml(){
        
        $this->conn = $this->get('database_connection');
        
        $session = $this->getRequest()->getSession();
        $id_perfil = $session->get('id_perfil');
        
        MenuRepository::geraMenuHtml($id_perfil, $this->conn);
        
    }
    
    public function criarMenuInternoAction()
    {
        return $this->render('WeblojaBundle:Menu:form_menu_interno.html.twig');
    }
}
