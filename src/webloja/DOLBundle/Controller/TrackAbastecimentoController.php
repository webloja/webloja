<?php

namespace webloja\DOLBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\MenuRepository;
use webloja\DOLBundle\Repository\TrackAbastecimentoRepository;
use Symfony\Component\HttpFoundation\Response;
use webloja\LIB\ExcelWriter;

class TrackAbastecimentoController extends Controller {

    public function relatorioAbastecimentoDiarioAction($id_interno) {

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

        if (!empty($_POST['data_dia'])) {

            /**
             * Código executado caso a data passada esteja respeite o formato: dd/MM/yyyy
             */
            list($dia, $mes, $ano) = explode("/", $_POST['data_dia']);

            if ($_POST['optionsRadios'] == 0) {

                $rCarregados = TrackAbastecimentoRepository::getTrackAbastecimentoCarregado($dia, $mes, $ano);
                return $this->render("DOLBundle:TrackAbastecimento:abastecimentoDiarioCarregado.html.twig", array('data' => $_POST['data_dia'], 'objTrackCarregados' => $rCarregados, 'id_interno' => $id_interno));
            } else {

                $rNCarregados = TrackAbastecimentoRepository::getTrackAbastecimentoNCarregado($dia, $mes, $ano);

                $rDadosArquivo = $this->getDadosArquivo($rNCarregados);

                return $this->render("DOLBundle:TrackAbastecimento:relatorioAbastecimentoNCarregado.html.twig", array('data' => $_POST['data_dia'], 'objTrackNCarregados' => $rNCarregados, 'id_interno' => $id_interno, 'arr' => $rDadosArquivo));
            
            }
        } else if (!empty($_POST['data_mes'])) {

            if ($_POST['optionsRadios'] == 0) {

                return $this->redirect($this->generateUrl('ExcelCarregados',array('data'=>$_POST['data_mes'])));
                return $this->render("DOLBundle:TrackAbastecimento:relatorioAbastecimentoDiario.html.twig");
            } else {
                return $this->redirect($this->generateUrl('ExcelNaoCarregados',array('data'=>$_POST['data_mes'])));
                return $this->render("DOLBundle:TrackAbastecimento:relatorioAbastecimentoDiario.html.twig");
            }
        } else {
            return $this->render("DOLBundle:TrackAbastecimento:relatorioAbastecimentoDiario.html.twig");
        }
    }

    public function getDadosArquivo($rows) {

        if (ini_get("mysql.default_host") == '52.31.153.101')
            $diretorio = '/lasa/usr/P64/COMNC/STARX/TRACKING/NAO_OK/';
        else
            $diretorio = '/nfs/ibmsap04_starx_tracking/NAO_OK/';

        $x = 0;
        $arr = array();

        foreach ($rows as $row) {

            if ($handle = fopen($diretorio . $row->arquivo, "r")) {

                while (!feof($handle)) {
                    $buffer = fgets($handle, 4096);

                    if ($buffer != "") {
                        $dados = explode(';', $buffer);

                        $arr[$x]['loja'] = $dados[0];
                        $arr[$x]['guia'] = $dados[1];
                        $arr[$x]['data'] = date("d/m/Y", filemtime($diretorio . $row->arquivo));

                        $x++;
                    }
                }

                fclose($handle);
            }

            if ($x == 0)
                $arr = array(array('loja' => 'N', 'guia' => 'N', 'data' => 'N'));
        }

        return $arr;
    }

    public function ExcelNaoCarregadosAction() {

        $request = $this->getRequest();
        $id_interno = $request->get("id_interno");
        
        if ($_REQUEST['data']) {
            list($mes, $ano) = explode("/", $_REQUEST['data']);
        } else {
            list($dia, $mes, $ano) = explode("/", $request->get("data"));
        }

        try {

            if (!empty($dia)) {
                $rNCarregados = TrackAbastecimentoRepository::getTrackAbastecimentoNCarregado($dia, $mes, $ano);
            } else {
                $rNCarregados = TrackAbastecimentoRepository::getTrackAbastecimentoNCarregadoMes($mes, $ano);
            }

            $rDadosArquivo = $this->getDadosArquivo($rNCarregados);

            $aquivo = "xlsTrackRelatorioDiario" . date('d') . "_" . date('m') . "_" . date('Y') . "_" . date('H') . "_" . date('i') . "_" . date('s') . ".xls";

            /**
             * instanciando objeto da classe ExcelWriter
             */
            $obj = new ExcelWriter();
            $obj->setNameArquivo($aquivo);
            // setando o nome do arquivo

            /**
             * criando a linha com os titulos das colunas
             */
            $obj->createTituloCol("Placa");
            $obj->createTituloCol("Tranportadora");
            $obj->createTituloCol("CD");
            $obj->createTituloCol("Loja");
            $obj->createTituloCol("Guia Remessa");
            $obj->createTituloCol("Data");
            $obj->createTituloCol("Motivo");

            $x = 0;

            /**
             * criando as colunas de conteudo da tabela
             */
            foreach ($rNCarregados as $value) {

                $obj->createCol($x, $value->placa);
                $obj->createCol($x, $value->transportadora);
                $obj->createCol($x, $value->cd);
                for ($y = 0; $y < count($rDadosArquivo); $y++) {
                    $obj->createCol($x, $rDadosArquivo[$y]['loja']);
                    $obj->createCol($x, $rDadosArquivo[$y]['guia']);
                    $obj->createCol($x, $rDadosArquivo[$y]['data']);
                }
                $obj->createCol($x, $value->mensagem_erro);
                $x++;
            }

            /**
             * gerando o arquivo excel
             */
            $excel = $obj->gerarExcel();

            /**
             * retornando arquivo para download
             */
            return new Response($excel);
        } catch (\Exception $e) {

            return new Response();
        }
    }

    public function ExcelCarregadosAction() {

        
        $request = $this->getRequest();
        $id_interno = $request->get("id_interno");
        
        if ($_REQUEST['data']) {
            list($mes, $ano) = explode("/", $_REQUEST['data']);
        } else {
            list($dia, $mes, $ano) = explode("/", $request->get("data"));
        }

        try {

            $aquivo = "xlsTrackRelatorioDiario" . date('d') . "_" . date('m') . "_" . date('Y') . "_" . date('H') . "_" . date('i') . "_" . date('s') . ".xls";

            if (!empty($dia)) {
                $rCarregados = TrackAbastecimentoRepository::getTrackAbastecimentoCarregado($dia, $mes, $ano);
            } else {
                $rCarregados = TrackAbastecimentoRepository::getTrackAbastecimentoCarregadoMes($mes, $ano);
            }

            /**
              $rCarregados[0]['loja'] ='L046';
              $rCarregados[0]['placa'] ='LAZ9066';
              $rCarregados[0]['transportadora'] ='LOJAS AMERICANAS S.A. CD151';
              $rCarregados[0]['guarita'] ='2013-04-30 18:45:06';
              $rCarregados[0]['entrada_loja'] ='2013-04-10 19:46:00';
              $rCarregados[0]['saida_loja'] ='2013-04-10 20:00:03';
              $rCarregados[0]['guia_remessa'] ='1000507269';
              $rCarregados[0]['situacao'] ='F';

              $rCarregados[1]['loja'] ='L050';
              $rCarregados[1]['placa'] ='LAZ9066';
              $rCarregados[1]['transportadora'] ='LOJAS AMERICANAS S.A. CD151';
              $rCarregados[1]['guarita'] ='2012-03-25 18:45:06';
              $rCarregados[1]['entrada_loja'] ='2013-03-27 19:46:00';
              $rCarregados[1]['saida_loja'] ='2013-04-15 20:00:03';
              $rCarregados[1]['guia_remessa'] ='1000507269';
              $rCarregados[1]['situacao'] ='E';
             * */
            $objE = new ExcelWriter();
            $objE->setNameArquivo($aquivo);

            $objE->createTituloCol("Loja");
            $objE->createTituloCol("Placa");
            $objE->createTituloCol("Transportadora");
            $objE->createTituloCol("Guarita");
            $objE->createTituloCol("Chegada");
            $objE->createTituloCol("Saida");
            $objE->createTituloCol("Documento");
            $objE->createTituloCol("Situacao");

            //$x=0;
            //foreach ($rCarregados as $value) {
            for ($x = 0; $x < count($rCarregados); $x++) {

                $objE->createCol($x, $rCarregados[$x]['loja']);
                $objE->createCol($x, $rCarregados[$x]['placa']);
                $objE->createCol($x, $rCarregados[$x]['transportadora']);

                $guarita = $rCarregados[$x]['guarita'] != "" ? strftime("%d/%m/%Y", strtotime($rCarregados[$x]['guarita'])) : "N";
                $objE->createCol($x, $guarita);

                $chegada = strftime("%d/%m/%Y", strtotime($rCarregados[$x]['entrada_loja']));
                $objE->createCol($x, $chegada);

                $saida = strftime("%d/%m/%Y", strtotime($rCarregados[$x]['saida_loja']));
                $objE->createCol($x, $saida);
                $objE->createCol($x, $rCarregados[$x]['guia_remessa']);

                $situacao = $rCarregados[$x]['situacao'] == 'F' ? 'S' : 'N';
                $objE->createCol($x, $situacao);
                /* $objE->createCol($x, $value->loja);
                  $objE->createCol($x, $value->placa);
                  $objE->createCol($x, $value->transportadora);
                  $objE->createCol($x, $value->guarita != "" ? $value->guarita : "N");
                  $chegada = new \DateTime($value->entrada_loja);
                  $objE->createCol($x, $chegada->format('d-m-Y'));
                  $saida = new \DateTime($value->saida_loja);
                  $objE->createCol($x, $saida->format('d-m-Y'));
                  $objE->createCol($x, $value->guia_remessa);
                  $objE->createCol($x, $value->situacao == 'F' ? 'S' : 'N');
                  $x++; */
            }

            $excel = $objE->gerarExcel();

            return new Response($excel);
            
        } catch (\Exception $e) {
            return new Response();
        }
    }

}
