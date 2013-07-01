<?php

namespace webloja\DCPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use webloja\WeblojaBundle\Repository\MenuRepository;

class QuebraController extends Controller {

    public function indexAction($id_interno) {

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

        if ($session->get('titulo_perfil') == "Gerente DCP") {
            
            return $this->render("DCPBundle:Quebra:indexGerente.html.twig", array('loja' => QuebraController::telaPerfilGerente()));
        } else {
            
            return $this->render("DCPBundle:Quebra:index.html.twig", array('ano' => QuebraController::telaPerfilLoja()));
        }
    }
    
    
    //Obtendo os dados a serem passados a tela de perfil Loja
    private function telaPerfilLoja()
    {
        //Carregando os anos do banco de dados
        $repositorio = $this->getDoctrine()->getRepository('DCPBundle:Quebra');

        $sql = $repositorio->createQueryBuilder('q')
                ->select('q.data')
                ->groupBy('q.data')
                ->getquery();

        $resultado = $sql->getResult();

        $anoGeral = array();
        $contAnoGeral = 0;
        foreach ($resultado as $data)
        {
            $anoGeral[$contAnoGeral] = $data["data"]->format("Y");
            $contAnoGeral++;
        }

        $ano = array();
        $contAno = 0;
        foreach ($anoGeral as $anoAPesquisar)
        {
            if (!in_array($anoAPesquisar, $ano))
            {
                $ano[$contAno] = $anoAPesquisar;
                $contAno++;
            }
        }

        return $ano;
    }

    //Obtendo os dados a serem passados a tela de perfil Gerente
    private function telaPerfilGerente()
    {
        //Carregando as lojas do banco de dados
        $repositorio = $this->getDoctrine()->getRepository('DCPBundle:Quebra');

        $sql = $repositorio->createQueryBuilder('l')
                ->select('l.id')
                ->groupby('l.id')
                ->getquery();

        $resultado = $sql->getResult();

        $loja = array();
        $contLoja = 0;
        foreach($resultado as $data)
        {
            if (!in_array($data, $loja))
            {
                $loja[$contLoja] = $data["id"];
                $contLoja++;
            }
        }
        
        return $loja;
    }

}
