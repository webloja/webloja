<?php
namespace webloja\LIB;
/**
 * 
 * Classe para gerar arquivo xls(excel), apartir de uma tabela
 * 
 * @author Douglas Silva
 * @version 1.0
 * 
 */
class ExcelWriter {

  private $arquivo;

/**
 * seta o nome do arquivo que será criado
 */
  function setNameArquivo($arquivo) {
    $this -> arquivo = $arquivo;
  }

/**
 * cria as colunas da tabela
 */
  function createCol($linha, $valor) {
    $this -> colConteudo[$linha][] = $valor;
  }

/**
 * cria a primeira linha com co titulo das colunas
 */
  function createTituloCol($valor) {
    $this -> titulo[] = $valor;
  }

/**
 * monta o arquivo html que dara horigem ao arquivo xls
 */
  private function createArquivo() {

    $html  = header("Content-type: application/vnd.ms-excel");
    $html .= header("Content-type: application/force-download");
    $html .= header("Content-Disposition: attachment; filename={$this->arquivo}");
    $html .= header("Pragma: no-cache");

    $html .= "<table border=1>";
    $html .= "<tr>";
    foreach ($this->titulo as $ti) {
      $html .= "<td><strong>{$ti}</strong></td>";
    }
    $html .= "</tr>";

    foreach ($this->colConteudo as $cC) {
      $html .= "<tr>";
      foreach ($cC as $col) {
        $html .= "<td>{$col}</td>";
      }
      $html .= "</tr>";
    }

    $html .= "</table>";

    return $html;
  }

/**
 * gera o arquivo xls
 */
  function gerarExcel() {
    return self::createArquivo();
  }

}
