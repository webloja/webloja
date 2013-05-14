<?php

namespace webloja\WeblojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Entity\Usuario;
use webloja\WeblojaBundle\Repository\MenuRepository;

class LoginController extends Controller
{
    public function indexAction(){
        $session = $this->getRequest()->getSession();
        
        if($session->get('id_user')){
            $session->clear();
        }
        
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
                    
                    /**
                     * Retorna os dados do Usuario de acordo com o login e a senha
                     */
                    $login = $this->getDoctrine()->getRepository("WeblojaBundle:Usuario")
                        ->getUsuarioSenha($data->getLogin(),$senha);
                    
                    /**
                     * Retorna o perfil de acordo com o id do perfil capiturado pela consulta anterior
                     */
                    $perfil = $this->getDoctrine()->getRepository("WeblojaBundle:Perfil")
                            ->getPerfil($login->getIdPerfil());
                    
                    /**
                     * Pega a loja que é central regional e joga na sessão
                     */
                    if (preg_replace("/[^A-z]/", "", $login->getLocal()) == "CR") {
                        
                        $session->set("central_regional", $login->getLocal());
                    }
                    /**
                     * Cria e atribiu valor as variáveis de sessão
                     */
                        $session->set("id_user", $login->getId());
                        $session->set("login", $login->getLogin());
                        $session->set("local", $login->getLocal());
                        $session->set("id_perfil", $login->getIdPerfil());
                        $session->set("titulo_perfil", $perfil->getPerfil());
                        $session->set("nome", $login->getNome());
                        $session->set("data_criacao", $login->getDataCriacao());
                        $session->set("loja_user", $login->getLocal());
                        
                        if(date("H:i:s") <= 12){
                            $boasVindas = "Bom Dia, ".$login->getNome().", Bem vindo ao Webloja!";
                        }else{
                            $boasVindas = "Boa Tarde, ".$login->getNome().", Bem vindo ao Webloja!";
                        }
                        
                        $session->set("boasVindas", $boasVindas);                  
                   
                        /**
                         * Criando o memu do sistema de acordo com o perfil do usuario
                         * logado.
                         */
                        if (preg_replace("/[^A-z]/", "", $login->getLocal()) == "CR") {
                            $cr = "CR"; 
                        }else{
                            $cr = null;
                        }
                        
                        MenuRepository::geraMenuHtml($login->getIdPerfil(),$cr);
                        
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
