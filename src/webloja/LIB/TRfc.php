<?php

namespace webloja\LIB;

/**
 * 
 * Classe para gerar rfc
 * 
 * @author Douglas Silva
 * @version 1.0
 * 
 */
use webloja\LIB\DBALConnection;

class TRfc {

  private $arrayDebug;
  private $table_Proc;
  private $fce;
  private $rfcId;

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

  // gera um novo id sap
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
  
  public static function getIpDesenvolvedores() {

    $conn = DBALConnection::getDBALConection();
    $sql = "select ip from lasasap.usuarios_desenvolvedores where debug = :debug";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("debug", 1);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  /**
   * MODULO DE ADAPTAÇÃO RFC
   * @return string
   * abre uma conexão com o sap
   */
  public function open() {

    $docRoot = $_SERVER['DOCUMENT_ROOT'];

    if (file_exists($docRoot . "/sap/novo/webloja_novo/src/webloja/LIB/rfcConfig.ini")) {

      $con = parse_ini_file($docRoot . "/sap/novo/webloja_novo/src/webloja/LIB/rfcConfig.ini");

      $LOGIN = array(
          "ASHOST" => "" . $con['host'] . "",
          "SYSNR" => "" . $con['sys'] . "",
          "CLIENT" => "" . $con['client'] . "",
          "USER" => "" . $con['user'] . "",
          "PASSWD" => "" . $con['passwd'] . "",
          "CODEPAGE" => "" . $con['code'] . "");

      $this->rfcId = saprfc_open($LOGIN);

    } else {
      return "Erro";
    }
  }

  //recupera a conexão
  public function getRfcId() {
    return $this->rfcId;
  }

  //verifica se a função rfc existe no sap
  public function getZCOM($zcom) {
    if (!saprfc_function_discover($this->getRfcId(), strtoupper($zcom))) {
      throw new \Exception("Erro na busca da função " . strtoupper($zcom) . " " . saprfc_error());
    } else {
      $this->fce = saprfc_function_discover($this->getRfcId(), strtoupper($zcom));
      $this->arrayDebug['RFC'] = strtoupper($zcom);
    }
  }

  //inicializa tabela
  public function initTable($value) {
    saprfc_table_init($this->fce, $value);
    $this->arrayDebug['TABLE'][] = $value;
  }

  //import de dados
  public function import($campo, $value) {
    saprfc_import($this->fce, $campo, $value);
    $this->arrayDebug['IMPORT'][$campo] = $value;
  }

  //export de dados
  public function export($value) {
    $this->arrayDebug['EXPORT'][] = $value;
    return saprfc_export($this->fce, $value);
  }

  //insert de dados
  public function insert($table, $item, $i) {
    saprfc_table_insert($this->fce, $table, array("LINE" => "" . $item . ""), $i);
    $this->arrayDebug['INSERT'][$table][] = $item;
  }

  //append de dados em tabela
  public function append($table, $item) {
    saprfc_table_append($this->fce, $table, array("LINE" => "" . $item . ""));
    $this->arrayDebug['APPEND'][$table][] = $item;
  }

  //ler dados de uma tabela
  public function tableRead($table) {
    $rows = saprfc_table_rows($this->fce, $table);
    for ($i = 1; $i <= $rows; $i++) {
      $this->table_Proc = saprfc_table_read($this->fce, $table, $i);
      $this->arrayDebug['RETURN_TABLE'][$table][] = trim($this->table_Proc['LINE']);
      $retorno[] = trim($this->table_Proc['LINE']);
    }
    return $retorno;
  }

  //mostra debug de entradas e saídas em uma array
  public function debug() {
    $remote = $_SERVER['REMOTE_ADDR'];
    $result2 = $this->getIpDesenvolvedores();
    $lista_ip = array();
    for ($z = 0; $z < count($result2); $z++) {
      $lista_ip[$z] = $result2[$z]['ip'];
    }

    if (in_array($remote, $lista_ip)) {
      return "<pre class='alert-error'>" . print_r($this->arrayDebug, true) . "</pre>";
    } else {
      return null;
    }
  }

  //mostra o debug gerado pela classe saprfc
  public function debugInfo() {
    saprfc_function_debug_info($this->fce);
  }

  //executa a rfc
  public function rfc_executa_rfc() {
    $err_ant = error_reporting(0);
    set_error_handler("saperror_handler");
    $rc = saprfc_call_and_receive($this->fce);
    error_reporting($err_ant);
    if ($rc != SAPRFC_OK) {
      exit;
    }
  }

  //fecha conexão
  public function rfcClose() {
    saprfc_function_free($this->fce);
    saprfc_close($this->getRfcId());
  }

}