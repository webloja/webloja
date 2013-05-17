<?php

namespace webloja\LIB;

use webloja\LIB\DBALConnection;

class TRfc {

    private $zcom;
    private $tbInit;
    private $debug = false;
    private $rfcId;

    public function setZCOM($zcom) {
        $this->zcom = strtoupper($zcom);
    }

    public function getZCOM() {
        return $this->zcom;
    }

    // Informa as tabelas que serão iniciadas.
    public function __set($tbInit, $value) {
        $this->tbInit[] = strtoupper($value);
    }

    // Adiciona parâmetros para importação.
    public function addImport($import, $value) {
        $data["imp"] = $import;
        $data["vle"] = $value;
        $this->imports[] = $data;
    }

    // Adiciona parâmetros para exportação.
    public function addExport($export) {
        $this->exports[] = $export;
    }

    // Insere os dados nas tabelas inicializadas.
    public function addInsert($table, $value) {
        $data["tbl"] = $table;
        $data["vle"] = $value;
        $this->inserts[] = $data;
    }

    // Faz o append dos dados nas tabelas inicializadas.
    public function addAppend($table, $value) {
        $data["tbl"] = $table;
        $data["vle"] = $value;
        $this->appends[] = $data;
    }

    // Fecha a conexão com o R3.
    private function close($fce) {
        saprfc_function_free($fce);
        saprfc_close($this->rfcId);
    }

    // Seta o identificador.
    protected function setIdSap() {
        $this->idSap = self::getIdSap();
    }

    //alterar par consulta normal
    public function setShowRfc() {

        $conn = DBALConnection::getDBALConection();
        $sql = "Select show_rfc from lasasap.config where show_rfc is not null";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getIdSap() {

        $conn = DBALConnection::getDBALConection();

        $sql = "select id from lasasap.sequence";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultId = $stmt->fetchAll();

        $idSeq = $resultId[0]['id'] + 1;

        if ($idSeq) {
            $conn->executeUpdate('UPDATE lasasap.sequence SET id = ? where id =?', array($idSeq, $resultId[0]['id']));
        }

        return str_pad($idSeq, 10, 0, STR_PAD_LEFT);
    }

    public function rfcDebug() {
        $this->debug = true;
    }

    public static function getIpDesenvolvedores() {
        
        $conn = DBALConnection::getDBALConection();
        $sql = "select ip from lasasap.usuarios_desenvolvedores where debug = :debug";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("debug", 1);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function debugRFC($obj){
        
        $remote = $_SERVER['REMOTE_ADDR'];
        $result2 = $this->getIpDesenvolvedores();
        $lista_ip = array();
        for($z=0;$z<count($result2);$z++){
            $lista_ip[$z] = $result2[$z]['ip'];
        }
        
        if (in_array("172.30.27.134", $lista_ip)) {
            return print_r($obj,true);
        }else{
            return null;
        }
    }

    // Executa a RFC.
    public function run() {

        
        $conRFC = $this->open("producao");
        
        if($conRFC!="Erro") {
            
            try {

            $fce = saprfc_function_discover($conRFC, $this->getZCOM());

                if (isset($this->imports)) {
                    foreach ($this->imports as $arrImport) {
                        saprfc_import($fce, $arrImport["imp"], $arrImport["vle"]);
                    }
                }

                if (isset($this->tbInit)) {
                    foreach ($this->tbInit as $tb_init) {
                        saprfc_table_init($fce, $tb_init);
                    }
                }

                if (isset($this->inserts)) {
                    $i = 1;
                    foreach ($this->inserts as $arrInserts) {
                        saprfc_table_insert($fce, $arrInserts["tbl"], array("LINE" => "" . $arrInserts["vle"] . ""), $i);
                        $i++;
                    }
                }

                if (isset($this->appends)) {
                    $i = 1;
                    foreach ($this->appends as $arrAppends) {
                        saprfc_table_append($fce, $arrAppends["tbl"], array("LINE" => "" . $arrAppends["vle"] . ""));
                        $i++;
                    }
                }

                $rc = saprfc_call_and_receive($fce);

                if (isset($this->tbInit)) {
                    $l = l;
                    foreach ($this->tbInit as $TABLE) {
                        unset($data, $rows);
                        $rows = saprfc_table_rows($fce, $TABLE);
                        for ($k = 1; $k <= $rows; $k++) {
                            $T_PROC = saprfc_table_read($fce, $TABLE, $k);
                            $data[$k] = $T_PROC["LINE"];
                        }

                        $this->tblOutRow[$TABLE] = $rows;
                        $this->tblOut[$TABLE] = $data;
                        $l++;
                    }
                }

                if (isset($this->exports)) {
                    foreach ($this->exports as $export) {
                        $this->setRetExport($export, $fce);
                    }
                }

                if ($this->debug) {
                     saprfc_function_debug_info($fce);
                }

                $this->close($fce);
                } catch (\Exception $exc) {
                    throw new \Exception("Erro;Falha na busca da funcao " . $this->getZCOM());
                }
        } else {
            throw new \Exception("Erro;Arquivo de conexão com SAP não encontrado !");
        }
    }

    public function setRetExport($export, $fce) {
        $this->retExports[$export] = saprfc_export($fce, $export);
    }

    public function getRetExport() {
        return $this->retExports;
    }

    // Retorna os dados das tabelas inicializadas.
    public function getTblOutIt($tbl, $line, $begin, $qtd) {
        return substr($this->tblOut[$tbl][$line], $begin, $qtd);
    }

    // Retorna a quantidade de linhas das tabelas inicializadas.
    public function getTblOutRow($tbl) {
        return $this->tblOutRow[$tbl];
    }

    /**
     * teste de conecção no mesmo arquivo
     */
    public function open($arquivo) {

        //usar em dominios com virtual host
        //$docRoot = dirname($_SERVER['DOCUMENT_ROOT']);

        $docRoot = $_SERVER['DOCUMENT_ROOT'];

        if (file_exists($docRoot . "/webloja/src/webloja/LIB/" . $arquivo . ".ini")) {

            $con = parse_ini_file($docRoot . "/webloja/src/webloja/LIB/" . $arquivo . ".ini");

            $LOGIN = array(
                "ASHOST" => "" . $con['host'] . "",
                "SYSNR" => "" . $con['sys'] . "",
                "CLIENT" => "" . $con['client'] . "",
                "USER" => "" . $con['user'] . "",
                "PASSWD" => "" . $con['passwd'] . "",
                "CODEPAGE" => "" . $con['code'] . "");


            $this->rfcId = saprfc_open($LOGIN);

            return $this->rfcId;
        }else{
            return "Erro";
        }
    }

    public function getRfcId() {
        return $this->rfcId;
    }

}
