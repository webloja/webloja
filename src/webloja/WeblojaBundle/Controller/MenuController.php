<?php

namespace webloja\WeblojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\MenuRepository;
use webloja\WeblojaBundle\Entity\Menu;
use webloja\WeblojaBundle\Entity\MenuInterno;
use webloja\WeblojaBundle\Entity\MenuDepartamento;
use webloja\WeblojaBundle\Form\MenuType;
use webloja\WeblojaBundle\Form\MenuDepartamentoType;
use webloja\WeblojaBundle\Form\MenuInternoType;

class MenuController extends Controller
{
    private $conn;
    
    public function menuAction()
    {
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
        
        return $this->render("::subMenuInterno.html.twig",array('objSubMenuInterno'=>$subMenuInterno));
        
    }
    
    public function MenuHtml(){
        
        $this->conn = $this->get('database_connection');
        
        $session = $this->getRequest()->getSession();
        $id_perfil = $session->get('id_perfil');
        
        MenuRepository::geraMenuHtml($id_perfil, $this->conn);
        
    }
    
    public function salvarMenuInternoAction($id = NULL)
    {
        $session    = $this->get('session');
        $requisicao = $this->getRequest();
        $id_interno = $session->get('id_interno');
        
        /**
         * Condigo referente a montagem do t�tulo da pagina
         * precisa se r colocado em toda p�gina que gera formul�rio
         * ou que tenha sa�da para templatef
         */
        if($id_interno!=null) {
             MenuRepository::getIdInterno($id_interno, $session);
        }     
        
        $menu_interno = new MenuInterno();
        if (!empty($id))
            $menu_interno = $this->getDoctrine()->getRepository('WeblojaBundle:MenuInterno')->find($id);
        
        $form = $this->createForm(new MenuInternoType(), $menu_interno);
        
        if ($requisicao->getMethod() == 'POST')
        {
            $form->bind($requisicao);
            
            if ($form->isValid())
            {
                try 
                {
                    $em = $this->getDoctrine()->getManager();
                    
                    // Ao criar um menu interno, se faz necessário selecionar um menu pai, portanto apaga-se a rota correspondente
                    $id_menu_interno_pai = $form->getData()->getPai()->getId();
                    $menu_interno_pai = $this->getDoctrine()->getRepository('WeblojaBundle:MenuInterno')->find($id_menu_interno_pai);
                    $menu_interno_pai->setLink(NULL);
                    $menu_interno_pai->setRota(NULL);
                    
                    $menu_interno->setPai($id_menu_interno_pai);
                    $em->persist($menu_interno_pai);
                    $em->persist($menu_interno);
                    $em->flush();

                    // armazena a mensagem de sucesso dentro de uma session 
                    $this->get('session')->getFlashBag()->add('success', 'Menu Interno ' . $menu_interno->getTitulo() . ' foi salvo com sucesso!');
                } 
                catch (Exception $e) 
                {
                    // armazena a mensagem de sucesso dentro de uma session 
                    $this->get('session')->getFlashBag()->add('error', 'Erro ao salvar o menu Interno ' . $menu_interno->getTitulo());
                }
                
                // redireciona para a listagem de produtos
                return $this->redirect($this->generateUrl('webloja_menu_interno'));
            }
        }
        
        return $this->render('WeblojaBundle:Menu:form_menu_interno.html.twig', array('form' => $form->createView(), 'id_menu' => $menu_interno->getId(), 'id_interno' => $id_interno));
    }
    
    public function excluirMenuInternoAction($id = NULL)
    {
        try
        {
            if (!$id)
                throw new Exception('ID está vazio!');
            
            $menu_interno = $this->getDoctrine()->getRepository('WeblojaBundle:MenuInterno')->find($id);
            
            if (!$menu_interno)
                throw $this->createNotFoundException('menu interno não existe!');
            
            $nome_menu_interno = $menu_interno->getTitulo();
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($menu_interno);
            $em->flush();
            
            // armazena a mensagem de sucesso dentro de uma session
            $this->get('session')->getFlashBag()->add('success', 'Menu Interno <b>' . $nome_menu_interno . '</b> foi excluído com sucesso!');

            // redireciona para a listagem de categorias
            return $this->redirect($this->generateUrl('webloja_menu_interno'));
        }
        catch(PDOException $e)
        {
            // armazena a mensagem de sucesso dentro de uma session
            $this->get('session')->getFlashBag()->add('error', 'O menu interno ' . $nome_menu_interno . ' não pode ser excluido, pois está associado ao menu ' . $menu_interno->getMenu()->getMenu());
        }
        catch(Exception $e)
        {
            $this->get('session')->getFlashBag()->add('error', 'Não foi possível excluir o registro, pois ' . $e->getMessage());
        }
        
        // redireciona para a listagem de categorias
        return $this->redirect($this->generateUrl('webloja_menu_consultar'));
    }
    
    public function salvarMenuAction($id = NULL)
    {
        $session = $this->get('session');
        $requisicao = $this->getRequest();
        $id_interno = $session->get('id_interno');
        
        /**
         * Condigo referente a montagem do t�tulo da pagina
         * precisa se r colocado em toda p�gina que gera formul�rio
         * ou que tenha sa�da para template
         */
        if($id_interno!=null) {
             MenuRepository::getIdInterno($id_interno, $session);
        }
        
        $menu = new Menu();
        if (!empty($id))
            $menu = $this->getDoctrine()->getRepository('WeblojaBundle:Menu')->find($id);
        
        
        $form = $this->createForm(new MenuType(), $menu);
        
        if ($requisicao->getMethod() == 'POST')
        {
            $form->bind($requisicao);
            
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();
                
                // armazena a mensagem de sucesso dentro de uma session
                $this->get('session')->getFlashBag()->add('success', 'Menu ' . $menu->getMenu() . ' salvo com sucesso!');
                
                // redireciona para a listagem de produtos
                return $this->redirect($this->generateUrl('webloja_menu_consultar'));
            }
        }
        
        return $this->render('WeblojaBundle:Menu:form_menu.html.twig', array('form' => $form->createView(), 'id_menu' => $menu->getId()));
    }
    
    public function excluirMenuAction($id)
    {
        try
        {
            if (!$id)
                throw new Exception('ID está vazio!');
            
            $menu = $this->getDoctrine()->getRepository('WeblojaBundle:Menu')->find($id);
            
            if (!$menu)
                throw $this->createNotFoundException('menu não existe!');
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($menu);
            $em->flush();
            
            // armazena a mensagem de sucesso dentro de uma session
            $this->get('session')->getFlashBag()->add('success', 'Menu ' . $menu->getMenu() . ' foi excluído com sucesso!');

            // redireciona para a listagem de categorias
            return $this->redirect($this->generateUrl('webloja_menu_consultar'));
        }
        catch(PDOException $e)
        {
            // armazena a mensagem de sucesso dentro de uma session
            $this->get('session')->getFlashBag()->add('error', 'O menu ' . $menu->getMenu() . ' não pode ser excluido, pois está associado ao departamento ' . $menu->getDepartamento()->getDepartamento());
        }
        catch(Exception $e)
        {
            $this->get('session')->getFlashBag()->add('error', 'Não foi possível excluir o registro, pois ' . $e->getMessage());
        }
        
        // redireciona para a listagem de categorias
        return $this->redirect($this->generateUrl('webloja_menu_consultar'));
    }
    
    public function consultarMenuPrincipalAction($id_interno)
    {
        $session    = $this->get('session');
        //$id_interno = $session->get('id_interno');
        
         /**
         * Condigo referente a montagem do t�tulo da pagina
         * precisa se r colocado em toda p�gina que gera formul�rio
         * ou que tenha sa�da para template
         */
        if($id_interno!=null) {
             MenuRepository::getIdInterno($id_interno, $session);
        }       
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $menusInternos = $em->getRepository('WeblojaBundle:Menu')->listarMenuPrincipal();
        
        return $this->render('WeblojaBundle:Menu:listar_menu_principal.html.twig', array('menus' => $menusInternos, 'id_interno' => $id_interno));
    }
    
    public function salvarMenuPrincipalAction($id = NULL)
    {
        $session = $this->get('session');
        $requisicao = $this->getRequest();
        $id_interno = $session->get('id_interno');
        
        /**
         * Condigo referente a montagem do t�tulo da pagina
         * precisa se r colocado em toda p�gina que gera formul�rio
         * ou que tenha sa�da para template
         */
        if($id_interno!=null) {
             MenuRepository::getIdInterno($id_interno, $session);
        }     
        
        $menu_departamento = new MenuDepartamento();
        if (!empty($id))
            $menu_departamento = $this->getDoctrine()->getRepository('WeblojaBundle:MenuDepartamento')->find($id);
        
        
        $form = $this->createForm(new MenuDepartamentoType(), $menu_departamento);
        
        if ($requisicao->getMethod() == 'POST')
        {
            $form->bind($requisicao);
            
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu_departamento);
                $em->flush();
                
                // armazena a mensagem de sucesso dentro de uma session
                $this->get('session')->getFlashBag()->add('success', 'Departamento ' . $menu_departamento->getDepartamento() . ' salvo com sucesso!');
                
                // redireciona para a listagem de produtos
                return $this->redirect($this->generateUrl('webloja_menu_principal'));
            }
        }
        
        return $this->render('WeblojaBundle:Menu:form_menu_principal.html.twig', array('form' => $form->createView(), 'id_menu' => $menu_departamento->getId()));
    }
    
    
    public function consultarMenuAction($id_interno)
    {
        $session = $this->get('session');
        //$id_interno = $session->get('id_interno');
        
         /**
         * Condigo referente a montagem do t�tulo da pagina
         * precisa se r colocado em toda p�gina que gera formul�rio
         * ou que tenha sa�da para template
         */
        if($id_interno!=null) {
             MenuRepository::getIdInterno($id_interno, $session);
        }        
        
        $em = $this->getDoctrine()->getManager();
        
        $menusInternos = $em->getRepository('WeblojaBundle:Menu')->listarMenus();
        
        return $this->render('WeblojaBundle:Menu:listar_menu.html.twig', array('menus' => $menusInternos, 'id_interno' => $id_interno));
    }
    
    public function consultarMenuInternoAction($id_interno, $id_menu = NULL)
    {
        $session = $this->get('session');
        //$id_interno = $session->get('id_interno');
        
        /**
         * Condigo referente a montagem do t�tulo da pagina
         * precisa se r colocado em toda p�gina que gera formul�rio
         * ou que tenha sa�da para template
         */
        if($id_interno!=null) {
             MenuRepository::getIdInterno($id_interno, $session);
        }       
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $menusInternos = $em->getRepository('WeblojaBundle:MenuInterno')->listarMenusInternos($id_menu);
        
        return $this->render('WeblojaBundle:Menu:listar_menu_interno.html.twig', array('menus' => $menusInternos, 'id_interno' => $id_interno));
    }
}
