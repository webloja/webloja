<?php

namespace webloja\WeblojaBundle\Repository;

class MenuRepository {

    public static function getMenu($id_perfil, $conn) {

        return $conn->fetchAll("SELECT d.id_departamento, d.departamento, d.ordem 
            FROM lasasap.menu_departamentos d 
            JOIN lasasap.menu m ON m.id_departamento = d.id_departamento 
            JOIN lasasap.menu_perfil p ON p.id_menu = m.id_menu 
            WHERE (p.id_perfil = $id_perfil) 
            GROUP BY id_departamento ORDER BY d.ordem ASC");
    }

    public static function getSubMenu($id_departamento, $id_perfil, $conn) {

        return $conn->fetchAll("SELECT m.id_menu, m.menu 
            FROM lasasap.menu m 
            JOIN lasasap.menu_perfil p ON p.id_menu = m.id_menu 
            WHERE (p.id_perfil = $id_perfil and m.ativo = 1 and m.id_departamento = $id_departamento ) 
            ORDER BY ordem ASC");
    }
    
    public static function getSubMenuInterno($id_menu,$conn){
        
        return $conn->fetchAll("SELECT id_interno, titulo, link 
            FROM lasasap.menu_interno 
            WHERE (id_menu = $id_menu AND ativo = '1')");

    }

}