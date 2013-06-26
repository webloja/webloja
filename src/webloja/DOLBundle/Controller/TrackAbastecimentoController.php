<?php

namespace webloja\DOLBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\MenuRepository;
//use Symfony\Component\HttpFoundation\Response;

class TrackAbastecimentoController extends Controller
{
    
    public function relatorioAbastecimentoDiarioAction($id_interno){
        
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
        /*         * **************************************************** */

        /**
         * Condigo referente a montagem do tÃ­tulo da pagina
         * precisa ser colocado em toda pÃ¡gina que gera formulÃ¡rio
         * ou que tenha saÃ­da para template
         */
        if ($id_interno != null) {
            MenuRepository::getIdInterno($id_interno, $session);
        }
         
        if(!empty($_POST['data_dia'])){
//            echo "<pre>";
//            print_r($_POST);
//            echo "<pre>";  
            return $this->render("DOLBundle:TrackAbastecimento:abastecimentoDiarioCarregado.html.twig",array('data'=>$_POST['data_dia']));
        }else if(!empty($_POST['data_mes'])){
            echo "<pre>";
            print_r($_POST);
            echo "<pre>";
            return $this->render("DOLBundle:TrackAbastecimento:relatorioAbastecimentoDiario.html.twig");
        }else{
            return $this->render("DOLBundle:TrackAbastecimento:relatorioAbastecimentoDiario.html.twig");
        }
 
    }

}
