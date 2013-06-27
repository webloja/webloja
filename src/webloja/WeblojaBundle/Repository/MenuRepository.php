<?php

namespace webloja\WeblojaBundle\Repository;

use webloja\LIB\DBALConnection;

class MenuRepository {

    //Função para remover repetição do menu
    private static function removeRepeticao($vetor) {
        $vetorLimpo = Array();
        $cont = 0;
        foreach($vetor as $item) {
            if (!in_array($item, $vetorLimpo)) {
                $vetorLimpo[$cont] = $item;
                $cont++;
            }
        }
        return $vetorLimpo;
    }
    
	public function listarMenus()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT m, d FROM WeblojaBundle:Menu m JOIN m.departamento d ORDER BY m.menu ASC';
        $query = $em->createQuery($dql);
        
        return $query->getResult();
    }
    
    public function listarMenusInternos($id_menu)
    {
        $em = $this->getEntityManager();
        $dql = '';
        $query = '';
        if (is_null($id_menu))
        {
            $dql = 'SELECT m, a FROM WeblojaBundle:MenuInterno m JOIN m.menu a ORDER BY m.titulo ASC';
            $query = $em->createQuery($dql);
        }
        else
        {
            $dql = 'SELECT m, a FROM WeblojaBundle:MenuInterno m JOIN m.menu a WHERE m.id_menu = :menu ORDER BY m.titulo ASC';
            $query = $em->createQuery($dql);
            $query->setParameter('menu', $id_menu);
        }
        
        return $query->getResult();
    }
    
    public function listarMenuPrincipal()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT d FROM WeblojaBundle:MenuDepartamento d ORDER BY d.departamento ASC';
        $query = $em->createQuery($dql);
        
        return $query->getResult();
    }
	
    public static function getMenu($id_perfil) {

        $conn = DBALConnection::getDBALConection();
        $sql = "SELECT d.id_departamento, d.departamento, d.ordem 
            FROM lasasap.menu_departamentos d 
            JOIN lasasap.menu m ON m.id_departamento = d.id_departamento 
            JOIN lasasap.menu_perfil p ON p.id_menu = m.id_menu 
            WHERE p.id_perfil = :id_perfil AND d.ativo = :ativo
            GROUP BY d.id_departamento ORDER BY d.ordem ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("id_perfil",$id_perfil);
        $stmt->bindValue("ativo",1);
        $stmt->execute();
        $menu = MenuRepository::removeRepeticao($stmt->fetchAll());
        return $menu;
        
    }

    public static function getSubMenu($id_departamento, $id_perfil) {

        $conn = DBALConnection::getDBALConection();
        $sql = "SELECT m.id_menu, m.menu 
            FROM lasasap.menu m JOIN lasasap.menu_perfil p ON p.id_menu = m.id_menu 
            WHERE p.id_perfil = :id_perfil and m.ativo = 1 and m.id_departamento = :id_departamento  
            ORDER BY ordem ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("id_perfil",$id_perfil);
        $stmt->bindValue("id_departamento",$id_departamento);
        $stmt->execute();
        $subMenu = MenuRepository::removeRepeticao($stmt->fetchAll());
        return $subMenu;
        
    }

    public static function getSubMenuInterno($id_menu, $perfil) {

        if ($perfil == "CR") {
            $wherePefil = 'and permissao = 2';
        } else {
            $wherePefil = "";
        }
        $conn = DBALConnection::getDBALConection();
        $sql = "SELECT id_interno, titulo, link, rota, pai  
            FROM lasasap.menu_interno WHERE (id_menu = :id_menu AND ativo = :ativo and pai is null $wherePefil )";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("id_menu",$id_menu);
        $stmt->bindValue("ativo",1);
        $stmt->execute();
        $subMenuInterno = MenuRepository::removeRepeticao($stmt->fetchAll());
        return $subMenuInterno;
    }

    public static function getSubMenuInternoNivel2($id_menu) {

        $conn = DBALConnection::getDBALConection();
        $sql = "SELECT mi.pai,mi.id_menu,mi2.titulo FROM lasasap.menu_interno mi 
             inner join lasasap.menu_interno mi2 on mi2.id_interno=mi.pai 
             WHERE mi.id_menu = :id_menu AND mi.ativo = :ativo 
             and mi.pai is not null group by mi.pai";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("id_menu",$id_menu);
        $stmt->bindValue("ativo",1);
        $stmt->execute();
        $subMenuInternoNivel2 = MenuRepository::removeRepeticao($stmt->fetchAll());
        return $subMenuInternoNivel2;

    }

    public static function getSubMenuInternoNivel3($id_pai) {

        $conn = DBALConnection::getDBALConection();
        $sql = "SELECT id_interno, titulo, rota FROM lasasap.menu_interno 
            WHERE pai = :id_pai AND ativo = :ativo";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("id_pai",$id_pai);
        $stmt->bindValue("ativo",1);
        $stmt->execute();
        $subMenuInternoNivel3 = MenuRepository::removeRepeticao($stmt->fetchAll());
        return $subMenuInternoNivel3;

    }

    public static function geraMenuHtml($id_perfil, $cr) {

        $rMenu = MenuRepository::getMenu($id_perfil);

        $menuNav = '<div class = "navbar">' . "\n";
        $menuNav .= '<div class = "navbar-inner">' . "\n";
        $menuNav .= '<div class = "container">' . "\n";
        $menuNav .= '<ul class = "nav">' . "\n";
        $menuNav .= '<li><a href = "' . "{{ path('principal') }}" . '">Home</a></li>' . "\n";

        //montar menu departamentos
        for ($i = 0; $i < count($rMenu); $i++) {
            $menuNav .= '<li class = "dropdown">' . "\n";
            $menuNav .= '<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" >' . $rMenu[$i]["departamento"] . '<b class = "caret"></b></a>' . "\n";

            //subMenu
            $rSubMenu = MenuRepository::getSubMenu($rMenu[$i]["id_departamento"], $id_perfil);
            
            $menuNav .= '<ul class="dropdown-menu">' . "\n";
            for ($j = 0; $j < count($rSubMenu); $j++) {
                $menuNav .= '<li class="dropdown-submenu">' . "\n";
                $menuNav .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown-submenu">' . $rSubMenu[$j]["menu"] . '</a>' . "\n";
                //dados para o menu interno

                $rSubMenuInterno = MenuRepository::getSubMenuInterno($rSubMenu[$j]["id_menu"], $cr);

                $menuNav .= '<ul class="dropdown-menu">' . "\n";

                for ($si = 0; $si < count($rSubMenuInterno); $si++) {

                    if ($rSubMenuInterno[$si]["pai"] == null && $rSubMenuInterno[$si]["rota"] != null) {

                        $rotaP1 = $rSubMenuInterno[$si]["rota"];
                        $rotaP2 = $rSubMenuInterno[$si]["id_interno"];
                        if ($rotaP1) {
                            $rotaFinal = "{{ path('$rotaP1', {'id_interno': $rotaP2}) }}";
                        } else {
                            $rotaFinal = "{{ path('principal') }}";
                        }
                        $menuNav .= '<li><a href="' . $rotaFinal . '">' . $rSubMenuInterno[$si]["titulo"] . '</a></li>' . "\n";
                    } else {
                        $rSubMenuInterno2 = MenuRepository::getSubMenuInternoNivel2($rSubMenu[$j]["id_menu"]);
                        for ($mi = 0; $mi < count($rSubMenuInterno2); $mi++) {
                            $menuNav .='<li class="dropdown-submenu">';
                            $menuNav .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown-submenu">' . $rSubMenuInterno2[$mi]["titulo"] . '</a>' . "\n";
                            $menuNav .= '<ul class="dropdown-menu">' . "\n";
                            $rSubMenuInterno3 = MenuRepository::getSubMenuInternoNivel3($rSubMenuInterno2[$mi]["pai"]);
                            for ($u = 0; $u < count($rSubMenuInterno3); $u++) {
                                $rotaI1 = $rSubMenuInterno3[$u]["rota"];
                                $rotaI2 = $rSubMenuInterno3[$u]["id_interno"];
                                if ($rotaI1) {
                                    $rotaFinalI = "{{ path('$rotaI1', {'id_interno': $rotaI2}) }}";
                                } else {
                                    $rotaFinalI = "{{ path('principal') }}";
                                }
                                $menuNav .= '<li><a href="' . $rotaFinalI . '">' . $rSubMenuInterno3[$u]["titulo"] . '</a></li>' . "\n";
                            }
                            $menuNav .= '</ul>' . "\n";
                            $menuNav .= '</li>' . "\n";
                        }
                    }
                }
                $menuNav .= '</ul>' . "\n";
                $menuNav .= '</li>' . "\n";
            }
            $menuNav .= '</ul>' . "\n";
            $menuNav .= '</li>' . "\n";
        }
//fim do menu departamentos

        $menuNav .= '</ul>' . "\n";
        $menuNav .= '<div class="pull-right">
                        <input type="text" class="search-query" placeholder="Pesquisar">
                        <span class="add-on">
                            <a href="#" id="pesquisarIcon"><i class="icon-search"></i></a>
                        </span>
                    </div>';
        $menuNav .= '</div>' . "\n";
        $menuNav .= '</div>' . "\n";
        $menuNav .= '</div>';

        /**
         * Recuperando o DOCUMENT_ROOT do servidor e criando o arquivo de menu
         * baseado no perfil do usuario logado.
         */
        //$docRoot = dirname($_SERVER['DOCUMENT_ROOT']);
        //file_put_contents($docRoot . "/app/Resources/views/menuNavCache$id_perfil.html", $menuNav);
        //echo $docRoot . "/app/Resources/views/menuNavCache$id_perfil.html";
        //exit;
        $docRoot = $_SERVER['DOCUMENT_ROOT'];
        //file_put_contents($docRoot . "/weblojaAptana/app/Resources/views/menuNavCache$id_perfil.html", $menuNav);
        file_put_contents($docRoot . "/sap/novo/webloja_novo/app/Resources/views/menuNavCache$id_perfil.html", $menuNav);
        
    }

    public static function getIdInterno($id_interno, $session) {

        $conn = DBALConnection::getDBALConection();

        if ($id_interno != "home" && $id_interno != "logout") {

            $sql = "SELECT mi.id_interno,mi.id_menu, mi.titulo, m.menu, mi.pai 
                FROM lasasap.menu_interno mi INNER JOIN lasasap.menu m on m.id_menu = mi.id_menu 
                WHERE id_interno = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue("id", $id_interno);
            $stmt->execute();
            $rMenuInterno = $stmt->fetchAll();

            $session->set('id_interno', $rMenuInterno[0]['id_interno']);
            $session->set('menu', $rMenuInterno[0]['menu']);
            $session->set('titulo', $rMenuInterno[0]['titulo']);

            if ($rMenuInterno[0]['pai'] != NULL) {
                $pai = $rMenuInterno[0]['pai'];

                $sql2 = "select titulo from lasasap.menu_interno where id_interno = :pai";
                $stmt = $conn->prepare($sql2);
                $stmt->bindValue("pai", $pai);
                $stmt->execute();
                $rPai = $stmt->fetchAll();

                $session->set('menu_pai', $rPai[0]['titulo']);
            } else {
                $session->remove('menu_pai');
            }
        }
    }

}