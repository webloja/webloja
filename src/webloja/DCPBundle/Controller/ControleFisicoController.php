<?php

namespace webloja\DCPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\MenuRepository;
use Symfony\Component\HttpFoundation\Response;

class ControleFisicoController extends Controller {

  public function indexControleFisico9000Action($id_interno) {
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

    return $this->render("DCPBundle:ControleFisico:indexControleFisico9000.html.twig");
  }

  public function validaSapAction() {


//    $sap = str_pad($_REQUEST['sap'], 12, 0, LEFT_PAD);
//    $indice = $_REQUEST['indice'];
//    $range = $_REQUEST['range'];
    $gpr = $_REQUEST['gpr'];
//    $desc = $_REQUEST['desc'];
    $gprsap = $_REQUEST['gprsap'];
    $tipoCod = $_REQUEST['tipoCod'];

    /**
     * Codigo fonte para tipo SAP
     */
    if ($tipoCod == "SAP") {
      
      if ($gpr == 2) { // Código para controle 2
        
        $cod_sap = str_pad($gprsap, 12, 0, STR_PAD_LEFT);
        try {

          $em = $this->getDoctrine()->getManager();
          $query = $em->createQuery(
                          'SELECT i FROM WeblojaBundle:Itens i WHERE i.codSap = :codigo_sap'
                  )->setParameter('codigo_sap', $cod_sap);

          $item = $query->getResult();

          $arr = array(
              'cod' => $item[0]->getCodSap(),
              'descricao' => $item[0]->getDescricao()
          );

          $arrFormatado = json_encode($arr);

          return new Response($arrFormatado);
        } catch (\Exception $exc) {

          return new Response(0);
        }
      } else if ($gpr == 3) { // Código para controle 3

        $arrSap = explode("\n", $gprsap);

        $x = 0;

        foreach ($arrSap as $cod) {

            $cod_sap = str_pad($cod, 12, 0, STR_PAD_LEFT);

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                            'SELECT i FROM WeblojaBundle:Itens i WHERE i.codSap = :codigo_sap'
                    )->setParameter('codigo_sap', $cod_sap);

            $item = $query->getResult();

            $arr[$x] = array(
                'cod' => $item[0]->getCodSap(),
                'descricao' => $item[0]->getDescricao()
            );
            $x++;
        }

        $arrFormatado = json_encode($arr);

        return new Response($arrFormatado);
      }
    }else{
      /**
       * colocar aqui código fonte referente a consulta por EAN
       */
    }
  }
}
