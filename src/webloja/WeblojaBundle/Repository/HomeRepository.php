<?php

namespace webloja\WeblojaBundle\Repository;

class HomeRepository {

    public function getMarketing($loja, $conn) {

        return $conn->fetchAll("SELECT ntf.id_segmento, ntf.id, ntf.titulo, ntf.mensagem, 
            ntf.todas_lojas, ntf.destaque, pt.id_marketing FROM lasasap.mkt_notificacoes ntf 
            LEFT JOIN lasasap.notificacao_local lc ON lc.id_notificacao = ntf.id_notificacao 
            LEFT JOIN lasasap.papeletas p ON p.id_papeleta = ntf.id 
            LEFT JOIN lasasap.papeletas_tipo pt ON pt.id_tipo = p.id_tipo 
            LEFT JOIN lasasap.tipo_marketing tm ON tm.id_marketing = pt.id_marketing 
            WHERE (tm.id_marketing = 1 OR tm.id_marketing = 3 
                AND (ntf.todas_lojas = 1 OR ntf.lojas LIKE '%$loja%')) 
                    GROUP BY ntf.id ORDER BY ntf.id_notificacao DESC LIMIT 0, 7");
    }

    public function getMerchandising($loja, $conn) {

        return $conn->fetchAll("SELECT ntf.id_segmento, ntf.id, ntf.titulo, ntf.mensagem, 
            ntf.todas_lojas, ntf.destaque, pt.id_marketing FROM lasasap.mkt_notificacoes ntf 
            LEFT JOIN lasasap.notificacao_local lc ON lc.id_notificacao = ntf.id_notificacao 
            LEFT JOIN lasasap.papeletas p ON p.id_papeleta = ntf.id 
            LEFT JOIN lasasap.papeletas_tipo pt ON pt.id_tipo = p.id_tipo 
            LEFT JOIN lasasap.tipo_marketing tm ON tm.id_marketing = pt.id_marketing 
            WHERE (tm.id_marketing = 2 AND (ntf.todas_lojas = 1 OR ntf.lojas LIKE '%$loja%')) 
            GROUP BY ntf.id ORDER BY ntf.id_notificacao DESC LIMIT 0, 4");
    }

    public function getNoticiaDol($loja, $conn) {

        return $conn->fetchAll("SELECT nt.id_notificacao, nt.titulo, nt.mensagem, nt.id_aplicacao, nt.data, 
            nt.segmento, lc.local FROM lasasap.notificacao nt 
            JOIN lasasap.notificacao_local lc ON lc.id_notificacao = nt.id_notificacao 
            WHERE (DATE_FORMAT(ADDDATE(nt.data, INTERVAL '31' DAY), '%Y-%m-%d') >= curdate() 
            AND lc.local = '$loja' AND (nt.segmento = 2 OR nt.segmento = 4 OR nt.segmento = 21)) 
            GROUP BY id_notificacao ORDER BY data DESC LIMIT 6");
    }

    public function getNotificacaoGeral($loja, $conn) {

        return $conn->fetchAll("SELECT nt.id_notificacao, nt.titulo, nt.mensagem, nt.id_aplicacao, nt.data, 
            nt.segmento, lc.local FROM lasasap.notificacao nt 
            JOIN lasasap.notificacao_local lc ON lc.id_notificacao = nt.id_notificacao 
            WHERE (DATE_FORMAT(ADDDATE(nt.data, INTERVAL '31' DAY), '%Y-%m-%d') >= curdate() 
            AND lc.local = '$loja' AND nt.segmento <> '2' AND nt.segmento <> '4' AND nt.segmento <> '21') 
            GROUP BY id_notificacao ORDER BY data DESC LIMIT 6");
    }

    public function getBanner($conn, $setor) {

        return $conn->fetchAll("SELECT arquivo FROM lasasap.mkt_banners 
            WHERE (ativo = '1' AND (curdate() <= validade OR validade IS NULL) AND setor = $setor)");
    }

}

?>
