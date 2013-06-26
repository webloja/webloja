<?php

namespace webloja\DOLBundle\Repository;
use webloja\LIB\DBALConnection;

class TrackAbastecimentoRepository {

  public static function getTrackAbastecimentoCarregado($dia, $mes, $ano) {

    $conn = DBALConnection::getDBALConection();

    $sql = "SELECT cab.placa, cab.dt_hr_criacao, cab.dt_hr_saida AS guarita, det.loja, det.situacao, 
            det.dt_hr_entrada AS entrada_loja, det.dt_hr_saida AS saida_loja, det.situacao, transp.transportadora, 
            doc.guia_remessa FROM lasatrack.ctrl_track_cab AS cab JOIN lasasap.transportadora AS transp ON transp.placa = cab.placa
            JOIN lasatrack.ctrl_track_det AS det ON det.id_track_cab = cab.id_track_cab
            JOIN lasatrack.ctrl_track_doc AS doc ON doc.id_track_det = det.id_track_det
            WHERE (EXTRACT(YEAR FROM cab.dt_hr_criacao) = :ano 
            AND EXTRACT(MONTH FROM cab.dt_hr_criacao) = :mes 
            AND EXTRACT(DAY FROM cab.dt_hr_criacao) = :dia)
            ORDER BY cab.dt_hr_criacao DESC ";

    $stmt = $conn -> prepare($sql);
    $stmt -> bindValue("ano", $ano);
    $stmt -> bindValue("mes", $mes);
    $stmt -> bindValue("dia", $dia);
    $stmt -> execute();

    return $stmt -> fetchAll();
  }

  public static function getTrackAbastecimentoNCarregado($dia, $mes, $ano) {

    $conn = DBALConnection::getDBALConection();

    $sql = "SELECT mensagem_erro, arquivo, data_hora, SUBSTRING(arquivo,2,4) AS cd, transportadora, placa
                FROM lasatrack.ctrl_track_erro
                JOIN lasasap.transportadora ON placa = SUBSTRING(arquivo,10,7)
                WHERE (EXTRACT(YEAR FROM data_hora) = :ano 
                AND EXTRACT(MONTH FROM data_hora) = :mes 
                AND EXTRACT(DAY FROM data_hora) = :dia 
                AND SUBSTRING(mensagem_erro,1,18) <> 'Arquivo processado')
                ORDER BY data_hora DESC";

    $stmt = $conn -> prepare($sql);
    $stmt -> bindValue("ano", $ano);
    $stmt -> bindValue("mes", $mes);
    $stmt -> bindValue("dia", $dia);
    $stmt -> execute();

    return $stmt -> fetchAll();

  }

  public static function getTrackAbastecimentoCarregadoMes($mes, $ano) {

    $conn = DBALConnection::getDBALConection();

    $sql = "SELECT cab.placa, cab.dt_hr_criacao, cab.dt_hr_saida AS guarita, det.loja, det.situacao, 
            det.dt_hr_entrada AS entrada_loja, det.dt_hr_saida AS saida_loja, det.situacao, transp.transportadora, 
            doc.guia_remessa FROM lasatrack.ctrl_track_cab AS cab JOIN lasasap.transportadora AS transp ON transp.placa = cab.placa
            JOIN lasatrack.ctrl_track_det AS det ON det.id_track_cab = cab.id_track_cab
            JOIN lasatrack.ctrl_track_doc AS doc ON doc.id_track_det = det.id_track_det
            WHERE (EXTRACT(YEAR FROM cab.dt_hr_criacao) = :ano 
            AND EXTRACT(MONTH FROM cab.dt_hr_criacao) = :mes) 
            ORDER BY cab.dt_hr_criacao DESC ";

    $stmt = $conn -> prepare($sql);
    $stmt -> bindValue("ano", $ano);
    $stmt -> bindValue("mes", $mes);
    $stmt -> execute();

    return $stmt -> fetchAll();
  }
  
    public static function getTrackAbastecimentoNCarregadoMes($mes, $ano) {

    $conn = DBALConnection::getDBALConection();

    $sql = "SELECT mensagem_erro, arquivo, data_hora, SUBSTRING(arquivo,2,4) AS cd, transportadora, placa
                FROM lasatrack.ctrl_track_erro
                JOIN lasasap.transportadora ON placa = SUBSTRING(arquivo,10,7)
                WHERE (EXTRACT(YEAR FROM data_hora) = :ano 
                AND EXTRACT(MONTH FROM data_hora) = :mes
                AND SUBSTRING(mensagem_erro,1,18) <> 'Arquivo processado')
                ORDER BY data_hora DESC";

    $stmt = $conn -> prepare($sql);
    $stmt -> bindValue("ano", $ano);
    $stmt -> bindValue("mes", $mes);
    $stmt -> execute();

    return $stmt -> fetchAll();

  }

}
