<?php

namespace webloja\WeblojaBundle\Repository;

class MenuRepository {

    public static function getMenu($id_perfil, $conn) {

        return $conn->fetchAll("SELECT d.id_departamento, d.departamento, d.ordem 
            FROM lasasap.menu_departamentos d 
            JOIN lasasap.menu m ON m.id_departamento = d.id_departamento 
            JOIN lasasap.menu_perfil p ON p.id_menu = m.id_menu 
            WHERE (p.id_perfil = $id_perfil) 
            GROUP BY d.id_departamento ORDER BY d.ordem ASC");
    }

    public static function getSubMenu($id_departamento, $id_perfil, $conn) {

        return $conn->fetchAll("SELECT m.id_menu, m.menu 
            FROM lasasap.menu m 
            JOIN lasasap.menu_perfil p ON p.id_menu = m.id_menu 
            WHERE (p.id_perfil = $id_perfil and m.ativo = 1 and m.id_departamento = $id_departamento ) 
            ORDER BY ordem ASC");
    }

    public static function getSubMenuInterno($id_menu, $conn, $perfil) {

        if ($perfil == "CR") {
            $wherePefil = 'and permissao = 2';
        } else {
            $wherePefil = "";
        }
        return $conn->fetchAll("SELECT id_interno, titulo, link, rota, pai  
            FROM lasasap.menu_interno WHERE (id_menu = $id_menu AND ativo = '1' and pai is null $wherePefil )");
    }
    
     public static function getSubMenuInternoNivel2($id_menu, $conn) {

//        return $conn->fetchAll("SELECT pai FROM lasasap.menu_interno WHERE id_menu = $id_menu AND ativo = '1'
//and pai is not null group by pai");
         return $conn->fetchAll("SELECT mi.pai,mi.id_menu,mi2.titulo FROM lasasap.menu_interno mi 
             inner join lasasap.menu_interno mi2 on mi2.id_interno=mi.pai 
             WHERE mi.id_menu = $id_menu AND mi.ativo = '1' 
             and mi.pai is not null group by mi.pai");
    }
    
    public static function getSubMenuInternoNivel3($id_pai, $conn) {

        return $conn->fetchAll("SELECT id_interno, titulo, rota FROM lasasap.menu_interno 
            WHERE pai = $id_pai AND ativo = '1'");
    }

    public static function geraMenuHtml($id_perfil, $conn, $cr) {

        $rMenu = MenuRepository::getMenu($id_perfil, $conn);

        $menuNav = '<div class = "navbar">'."\n";
        $menuNav .= '<div class = "navbar-inner">'."\n";
        $menuNav .= '<div class = "container">'."\n";
        $menuNav .= '<ul class = "nav">'."\n";
        $menuNav .= '<li><a href = "'."{{ path('principal') }}".'">Home</a></li>'."\n";

        //montar menu departamentos
        for ($i = 0; $i < count($rMenu); $i++) {
            $menuNav .= '<li class = "dropdown">'."\n";
            $menuNav .= '<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" >' . $rMenu[$i]["departamento"] . '<b class = "caret"></b></a>'."\n";

            //subMenu
            $rSubMenu = MenuRepository::getSubMenu($rMenu[$i]["id_departamento"], $id_perfil, $conn);
            $menuNav .= '<ul class="dropdown-menu">'."\n";
            for ($j = 0; $j < count($rSubMenu); $j++) {
                $menuNav .= '<li class="dropdown-submenu">'."\n";
                $menuNav .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown-submenu">' . $rSubMenu[$j]["menu"] . '</a>'."\n";
                //dados para o menu interno

                $rSubMenuInterno = MenuRepository::getSubMenuInterno($rSubMenu[$j]["id_menu"], $conn, $cr);
               
                $menuNav .= '<ul class="dropdown-menu">'."\n";
      
                for ($si = 0; $si < count($rSubMenuInterno); $si++) {

                  if($rSubMenuInterno[$si]["pai"] == null && $rSubMenuInterno[$si]["rota"]!=null){
                            
                            $rotaP1 = $rSubMenuInterno[$si]["rota"];
                            $rotaP2 = $rSubMenuInterno[$si]["id_interno"];
                            if($rotaP1){
                                $rotaFinal="{{ path('$rotaP1', {'id_interno': $rotaP2}) }}";
                            }else{
                                $rotaFinal="{{ path('principal') }}";
                            }
                            $menuNav .= '<li><a href="' . $rotaFinal .'">' . $rSubMenuInterno[$si]["titulo"] . '</a></li>'."\n";
                 }else{
                         $rSubMenuInterno2 = MenuRepository::getSubMenuInternoNivel2($rSubMenu[$j]["id_menu"], $conn);
                         for($mi=0;$mi<count($rSubMenuInterno2);$mi++){
                         $menuNav .='<li class="dropdown-submenu">';           
                             $menuNav .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown-submenu">' . $rSubMenuInterno2[$mi]["titulo"] . '</a>'."\n";                    
                             $menuNav .= '<ul class="dropdown-menu">'."\n";
                             $rSubMenuInterno3 = MenuRepository::getSubMenuInternoNivel3($rSubMenuInterno2[$mi]["pai"], $conn);
                                for ($u = 0; $u < count($rSubMenuInterno3); $u++) {
                                    $rotaI1 = $rSubMenuInterno3[$u]["rota"];
                                    $rotaI2 = $rSubMenuInterno3[$u]["id_interno"];
                                    if($rotaI1){
                                        $rotaFinalI="{{ path('$rotaI1', {'id_interno': $rotaI2}) }}";
                                    }else{
                                        $rotaFinalI="{{ path('principal') }}";
                                    }
                                    $menuNav .= '<li><a href="' . $rotaFinalI .'">' . $rSubMenuInterno3[$u]["titulo"] . '</a></li>'."\n";
                                }
                            $menuNav .= '</ul>'."\n";
                            $menuNav .= '</li>'."\n";
                         }
                    }
            }
                $menuNav .= '</ul>'."\n";
                $menuNav .= '</li>'."\n";
        }
            $menuNav .= '</ul>'."\n";
            $menuNav .= '</li>'."\n";
    }
//fim do menu departamentos

        $menuNav .= '</ul>'."\n";
        $menuNav .= '</div>'."\n";
        $menuNav .= '</div>'."\n";
        $menuNav .= '</div>';

        /**
         * Recuperando o DOCUMENT_ROOT do servidor e criando o arquivo de menu
         * baseado no perfil do usuario logado.
         */
        $docRoot = dirname($_SERVER['DOCUMENT_ROOT']);
        //echo $docRoot . "/app/Resources/views/menuNavCache$id_perfil.html";
        //exit;
        file_put_contents($docRoot . "/app/Resources/views/menuNavCache$id_perfil.html", $menuNav);
    }
    
    public static function getIdInterno($id_interno,$conn){
        
        if($id_interno!="home" && $id_interno!="logout"){
            return $conn->fetchAll("SELECT mi.id_interno,mi.id_menu, mi.titulo, m.menu 
                FROM lasasap.menu_interno mi INNER JOIN lasasap.menu m on m.id_menu = mi.id_menu 
                WHERE (id_interno = $id_interno)");
        }
    }

}