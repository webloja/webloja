<?php

namespace webloja\DCPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\MenuRepository;
use Symfony\Component\HttpFoundation\Response;
use webloja\LIB\TRfc;
use webloja\DCPBundle\Entity\ControleFisico;

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

    if ($gpr == 2) { // Código para controle 2
      try {

        if ($tipoCod == "SAP") {

          $cod_sap = str_pad($gprsap, 12, 0, STR_PAD_LEFT);

          $em = $this->getDoctrine()->getManager();
          $query = $em->createQuery(
                          'SELECT i FROM WeblojaBundle:Itens i WHERE i.codSap = :codigo_sap'
                  )->setParameter('codigo_sap', $cod_sap);

          $item = $query->getResult();

          $arr = array(
              'cod' => $item[0]->getCodSap(),
              'descricao' => $item[0]->getDescricao()
          );
        } else {
          $ean = str_pad($gprsap, 13, 0, STR_PAD_LEFT);

          $em = $this->getDoctrine()->getManager();
          $query = $em->createQuery(
                          'SELECT i FROM WeblojaBundle:Itens i WHERE i.id = :ean'
                  )->setParameter('ean', $ean);

          $item = $query->getResult();

          $arr = array(
              'cod' => $item[0]->getId(),
              'descricao' => $item[0]->getDescricao()
          );
        }

        $arrFormatado = json_encode($arr);

        return new Response($arrFormatado);
      } catch (\Exception $exc) {

        return new Response(0);
      }
    } else if ($gpr == 3) { // Código para controle 3
      $arrSap = explode("\n", $gprsap);

      $x = 0;

      foreach ($arrSap as $cod) {

        if ($tipoCod == "SAP") {

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
        } else {

          $ean = str_pad($cod, 13, 0, STR_PAD_LEFT);

          $em = $this->getDoctrine()->getManager();
          $query = $em->createQuery(
                          'SELECT i FROM WeblojaBundle:Itens i WHERE i.id = :ean'
                  )->setParameter('ean', $ean);

          $item = $query->getResult();

          $arr[$x] = array(
              'cod' => $item[0]->getId(),
              'descricao' => $item[0]->getDescricao()
          );
        }
        $x++;
      }

      $arrFormatado = json_encode($arr);

      return new Response($arrFormatado);
    }
  }

  public function verificaProntuarioControle9000Action() {

    $request = $this->getRequest();
    $prontuario = $request->get("prontuario");
    $senha = $request->get("senha");

      
    $response = $this->forward('AdminBundle:Admin:verificaProntuario', array('prontuario' => $prontuario));
    if ($response->getContent() == "R") {
      /**
       * prontuario não existe no SAP
       */
      
      return new Response("* Prontuário " . $prontuario . " não existe !");
    } else {

      list($prontuario, $status, $nome) = explode(";", $response->getContent());
      
      if ($status == 3) {

        $session = $this->getRequest()->getSession();
        $loja = $session->get('local');

        $em = $this->getDoctrine()->getManager();
        $resultProntuario = $em->getRepository('AdminBundle:CFUsuario')->findOneBy(array('prontuario' => $prontuario, 'senha' => base64_encode($senha), 'loja' => $loja));

        if ($resultProntuario != null) {

          $qtdRadio = $request->get("qtdRadio");
          $materiaisValidos = $request->get("materiais_validos");
          $tipo = $request->get("tipoCod");
          $qtd_mat = $request->get("qtd_material");

          $response = $this->forward('DCPBundle:ControleFisico:createControleFisico9000', array('prontuario' => $prontuario, 'senha' => $senha, 'qtdRadio' => $qtdRadio, 'materiais_validos' => $materiaisValidos, 'tipoCod' => $tipo, 'qtd_material' => $qtd_mat, 'id_user' => $resultProntuario->getId()));

          return new Response($response->getContent());
        } else {
          /**
           * prontuario ou senha digitado errado
           */
          return new Response("* Prontuário ou senha inválido !");
        }
      } else {
        /**
         * prontuário existe no SAP mas esta inativo
         */
        return new Response("* Prontuário " . $prontuario . " não esta ativo");
      }
    }
  }

  public function createControleFisico9000Action() {

    $request = $this->getRequest();
    $prontuario = $request->get("prontuario");
    $senha = $request->get("senha");
    $qtdRadio = $request->get("qtdRadio");

    $controleFisico = new ControleFisico();

    $session = $this->getRequest()->getSession();
    $loja = $session->get('local');
    /**
     * pegando o ultimo id_envio da tabela e fazendo o incremento para gerar o novo id_envio
     */
    $repository = $this->getDoctrine()->getRepository('DCPBundle:ControleFisico');
    $query = $repository->createQueryBuilder('i')
            ->orderBy('i.idEnvio', 'DESC')
            ->setMaxResults(1)
            ->getQuery();

    $result = $query->getResult();

    if ($result != null) {
      $id_envio = $result[0]->getIdEnvio() + 1;
    } else {
      $id_envio = 0;
    }

    /**
     * inicio da classe RFC
     */
    $rfc = new TRfc();
    $rfc->open();
    $rfc->getZCOM("ZCOM_CONTROLE_ESTOQUE_9000");

    //----Bloco para iniciar as tabelas--
    $rfc->initTable("TI_MATNR");
    $rfc->initTable("TI_MATNR");
    $rfc->initTable("TI_DEPTO");
    $rfc->initTable("TI_ITENS");
    $rfc->initTable("TI_SAIDA");
    //-----------------------------------
    
    $depos = "9000";
    $dpdest = "0001";
    $mvto = "911";
    
    //----Bloco de imports--------------
    $rfc->import("I_LOJA", $loja);
    $rfc->import("I_DEPOS", $depos);
    $rfc->import("I_DPDEST", $dpdest);
    $rfc->import("I_MOVTO", $mvto);
    $rfc->import("I_FLAG", $qtdRadio);
    //-----------------------------------
    
    $buscaMat = false;

    if ($qtdRadio == 1) {
      $i=1;
      foreach ($request->get("materiais_validos") as $mat) {

        if ($request->get("tipoCod") == "EAN") {
          /**
           * pegar o codigo sap atravez do EAN
           */
          $mat = $this->getCodSap($mat);
        }


        $controleFisico->setIdEnvio($id_envio);
        $controleFisico->setDtEnvio(new \DateTime(date('Y-m-d h:i:s')));
        $controleFisico->setLoja($loja);
        $controleFisico->setIdUser($request->get("id_user"));
        $controleFisico->setCodSapInicio($mat);


        $em = $this->getDoctrine()->getManager();
        $em->persist($controleFisico);
        $em->flush();

        $strItem = "EQ";
        $strItem .= str_pad(trim($mat), 18, 0, STR_PAD_LEFT);
        
        //----Bloco inserts------------------------------
        $rfc->insert("TI_MATNR", $strItem, $i);
        //-----------------------------------------------

        $buscaMat = true;
        $i++;
      }
    } else {

      /**
       * caso o material possua quantidade definida
       */
      foreach ($request->get("qtd_material") as $key => $qtd) {
        $arrayQtd[] = $qtd;
      }
      foreach ($request->get("materiais_validos") as $key => $mat) {
        $buscaMat = true;
        $arrayMat[] = $mat;
      }

      foreach ($arrayMat as $key => $value) {
        if ($request->get("tipoCod") == "EAN") {
          /**
           * pegar o codigo sap atravez do EAN
           */
          $mat = $this->getCodSap($value);
        }else{
          $mat = $value;
        }

        $qtd = $arrayQtd[$key];

        $controleFisico->setIdEnvio($id_envio);
        $controleFisico->setDtEnvio(new \DateTime(date('Y-m-d h:i:s')));
        $controleFisico->setLoja($loja);
        $controleFisico->setIdUser($request->get("id_user"));
        $controleFisico->setCodSapInicio($mat);
        $controleFisico->setQtd($qtd);

        $em = $this->getDoctrine()->getManager();
        $em->persist($controleFisico);
        $em->flush();

        $strItem = str_pad(trim($mat), 18, 0, STR_PAD_LEFT);
        $strItem .= $qtd;

        $strMat = "EQ";
        $strMat .= str_pad(trim($mat), 18, 0, STR_PAD_LEFT);

        //----Bloco append------------------------------
        $rfc->append("TI_ITENS", $strItem);
        $rfc->append("TI_MATNR", $strMat);
        //----------------------------------------------

      }
    }
//return new Response(print_r('<pre>'.$rfc->debugRFC($rfc).'</pre>', true));
    //----Executa a RFC-------------------
    $rfc->rfc_executa_rfc();
    //------------------------------------
    //----Bloco para leitura de tabelas----------------
    $resp = $rfc->tableRead('TI_SAIDA');
    for($i=1;$i<count($resp);$i++){
        $arrMsg = explode("01000000", $resp[$i]);
        $tpmsg = substr($resp[$i], 0, 2);
        if ($tpmsg == "01") {
          return new Response("<pre>".print_r($resp,true)."</pre>");
        }else{
          $retorno = $tpmsg.";"."333222666222;10;teste;Realizado com sucesso";
          return new Response($retorno);
        }
    }
    
    
//    for($i=1; $i<=$rfc->tableRows('TI_SAIDA'); $i++) {
//       $resp.= $rfc->tableRead('TI_SAIDA', $i);
//    }
    //-------------------------------------------------
    //$arrMsg = explode("01000000", $resp);
    //$tpmsg = substr($resp, 0, 2);
    
    // arrumar aqui
//    foreach ($arrMsg as $m) {
//                $sap_msg = substr($m, 0, 12);
//                $qtd_msg = substr($m, 12, 16);
//                $doc_msg = substr($m, 28, 15);
//                $status_msg = substr($m, 43);
//
//                $qtd_msg_arr = explode(".", trim($qtd_msg));
//                $qtd_msg = $qtd_msg_arr[0];
//
//                $doc_msg = str_replace("Doc.", "", $doc_msg);
//
//                $tmessage .= "<tr>";
//                $tmessage .= "<td style='border: 2px solid #999;'>" . trim($sap_msg) . "</td>";
//                $tmessage .= "<td align='center' style='border: 2px solid #999;'>" . trim($qtd_msg) . "</td>";
//                $tmessage .= "<td style='border: 2px solid #999;'>" . trim($doc_msg) . "</td>";
//                $tmessage .= "<td align='center' style='border: 2px solid #999;'>" . trim($status_msg) . "</td>";
//                $tmessage .= "</tr>";
//
//                //if(trim($status_msg) != 'criado com sucesso.')
//                self::inserirDadosControleStatus($id_envio, trim($status_msg), $prontuario, trim($sap_msg), trim($qtd_msg));
//            }
    

    //$resp = '';
    //for ($i = 2; $i <= $rfc->getTblOutRow('TI_SAIDA'); $i++) {
      //$resp .= $rfc->getTblOutIt('TI_SAIDA', $i);
    //}

    //$arrMsg = explode("01000000", $resp);
    //$tpmsg = substr($resp, 0, 2);
    //return new Response(print_r($rfc->debugRFC($rfc), true));
    
  }

  public function getCodSap($ean) {

    $em = $this->getDoctrine()->getManager();
    return $em->getRepository('WeblojaBundle:Itens')->findOneBy(array('id' => $ean));
  }

  public function getDpto($item) {

    $em = $this->getDoctrine()->getManager();
    return $em->getRepository('WeblojaBundle:Itens')->findOneBy(array('codSap' => $item));
  }

}
