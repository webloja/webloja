<?php

namespace webloja\WeblojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Entity\Usuario;

class LoginController extends Controller
{
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $usuario = new Usuario();
       
        $form = $this->createFormBuilder($usuario)
                ->add("login",'text')
                ->add("senha",'password')
                ->getForm();
        
        $requisicao = $this->getRequest();
        
        if ($requisicao->isMethod('POST')) {
            $form->bind($requisicao);
            if ($form->isValid()) {
      
                try {
                    
                    $data = $form->getData();
                    $senha = base64_encode($data->getSenha());
                
                    $login = $this->getDoctrine()->getRepository("WeblojaBundle:Usuario")
                        ->getUsuarioSenha($data->getLogin(),$senha);
               
//    $titulo_perfil = TSession::getValue('titulo_perfil'); pegar na tabela perfil                       
                        
                        $session->set("id_user", $login->getId());
                        $session->set("login", $login->getLogin());
                        $session->set("local", $login->getLocal());
                        $session->set("id_perfil", $login->getIdPerfil());
                        $session->set("nome", $login->getNome());
                        $session->set("loja_user", $login->getLocal());
                        
                        if(date("H:i:s") <= 12){
                            $boasVindas = "Bom Dia, ".$login->getNome().", Bem vindo ao Webloja!";
                        }else{
                            $boasVindas = "Boa Tarde, ".$login->getNome().", Bem vindo ao Webloja!";
                        }
                        
                        $session->set("boasVindas", $boasVindas);                  
                    
                    return $this->redirect($this->generateUrl('principal'));
                    
                } catch (\Exception $e) {
                    $session->clear();
                    $this->get('session')->getFlashBag()->add('notice', "Usuário ou senha inválido!");
                    return $this->redirect($this->generateUrl('login'));
                }

                
            
            }
        }

        
        return $this->render('WeblojaBundle:Home:index.html.twig', array(
                    'form' => $form->createView()));
    }
}
