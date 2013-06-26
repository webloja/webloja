<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        if (0 === strpos($pathinfo, '/Ocorrencia')) {
            // Ocorrencia
            if (preg_match('#^/Ocorrencia/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Ocorrencia')), array (  '_controller' => 'webloja\\ChamadosBundle\\Controller\\ChamadosController::indexAction',));
            }

            // OcorrenciaNovo
            if (rtrim($pathinfo, '/') === '/Ocorrencia/Novo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'OcorrenciaNovo');
                }

                return array (  '_controller' => 'webloja\\ChamadosBundle\\Controller\\ChamadosController::novoAction',  '_route' => 'OcorrenciaNovo',);
            }

        }

        // OcorrenciaListar
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'OcorrenciaListar');
            }

            return array('_route' => 'OcorrenciaListar');
        }

        // select_modulos
        if ($pathinfo === '/Modulos') {
            return array (  '_controller' => 'webloja\\ChamadosBundle\\Controller\\ChamadosController::moduloAction',  '_route' => 'select_modulos',);
        }

        // select_links
        if ($pathinfo === '/Links') {
            return array (  '_controller' => 'webloja\\ChamadosBundle\\Controller\\ChamadosController::linkAction',  '_route' => 'select_links',);
        }

        if (0 === strpos($pathinfo, '/hello')) {
            // grl_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'grl_homepage')), array (  '_controller' => 'GrlBundle:Default:index',));
            }

            // seng_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'seng_homepage')), array (  '_controller' => 'SengBundle:Default:index',));
            }

            // dcm_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'dcm_homepage')), array (  '_controller' => 'DcmBundle:Default:index',));
            }

            // merchen_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'merchen_homepage')), array (  '_controller' => 'webloja\\MerchanBundle\\Controller\\DefaultController::indexAction',));
            }

        }

        if (0 === strpos($pathinfo, '/Admin')) {
            // AdminUsuarioNovo
            if (0 === strpos($pathinfo, '/Admin/Usuario/Novo') && preg_match('#^/Admin/Usuario/Novo/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'AdminUsuarioNovo')), array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::indexAction',));
            }

            // AdminCFUserProntuario
            if (0 === strpos($pathinfo, '/Admin/CF/Prontuario') && preg_match('#^/Admin/CF/Prontuario/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'AdminCFUserProntuario')), array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::newUserProntuarioAction',));
            }

            // AdminVerificaProntuario
            if ($pathinfo === '/Admin/Verifica/Prontuario') {
                return array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::verificaProntuarioAction',  '_route' => 'AdminVerificaProntuario',);
            }

            if (0 === strpos($pathinfo, '/Admin/Update/Senha')) {
                // AdminUpdateSenhaUsuario
                if (0 === strpos($pathinfo, '/Admin/Update/Senha/Usuario') && preg_match('#^/Admin/Update/Senha/Usuario/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'AdminUpdateSenhaUsuario')), array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::updateSenhaUsuarioAction',));
                }

                // AdminUpdateSenhaProntuario
                if (0 === strpos($pathinfo, '/Admin/Update/Senha/Prontuario') && preg_match('#^/Admin/Update/Senha/Prontuario/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'AdminUpdateSenhaProntuario')), array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::updateUserProntuarioAction',));
                }

            }

            // AdminVerificaSenhaProntuario
            if ($pathinfo === '/Admin/Verifica/Senha/Prontuario') {
                return array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::verificaSenhaProntuarioAction',  '_route' => 'AdminVerificaSenhaProntuario',);
            }

            // ResetSenhaProntuario
            if (0 === strpos($pathinfo, '/Admin/Reset/Senha/Prontuario') && preg_match('#^/Admin/Reset/Senha/Prontuario/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'ResetSenhaProntuario')), array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::resetSenhaProntuarioAction',));
            }

            // UpdateLojaProntuario
            if (0 === strpos($pathinfo, '/Admin/Update/Loja/Prontuario') && preg_match('#^/Admin/Update/Loja/Prontuario/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'UpdateLojaProntuario')), array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::updateLojaProntuarioAction',));
            }

            // NovaLojaProntuario
            if (0 === strpos($pathinfo, '/Admin/Nova/Loja/Prontuario') && preg_match('#^/Admin/Nova/Loja/Prontuario/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'NovaLojaProntuario')), array (  '_controller' => 'webloja\\AdminBundle\\Controller\\AdminController::novaLojaProntuarioAction',));
            }

        }

        if (0 === strpos($pathinfo, '/hello')) {
            // mkt_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'mkt_homepage')), array (  '_controller' => 'MktBundle:Default:index',));
            }

            // dfi_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'dfi_homepage')), array (  '_controller' => 'DfiBundle:Default:index',));
            }

        }

        if (0 === strpos($pathinfo, '/DCP')) {
            // DCPCriarControleFisico9000
            if (0 === strpos($pathinfo, '/DCP/Criar/Controle/Fisico/9000') && preg_match('#^/DCP/Criar/Controle/Fisico/9000/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'DCPCriarControleFisico9000')), array (  '_controller' => 'webloja\\DCPBundle\\Controller\\ControleFisicoController::indexControleFisico9000Action',));
            }

            // ValidaSAPControleFisico9000
            if ($pathinfo === '/DCP/Valida/SAP/Controle/Fisico/9000') {
                return array (  '_controller' => 'webloja\\DCPBundle\\Controller\\ControleFisicoController::validaSapAction',  '_route' => 'ValidaSAPControleFisico9000',);
            }

        }

        // da_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'da_homepage')), array (  '_controller' => 'DABundle:Default:index',));
        }

        // TrackAbastecimentoRelatorioDiario
        if (0 === strpos($pathinfo, '/Track/Abastecimento/Relatorio/Diario') && preg_match('#^/Track/Abastecimento/Relatorio/Diario/(?P<id_interno>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'TrackAbastecimentoRelatorioDiario')), array (  '_controller' => 'webloja\\DOLBundle\\Controller\\TrackAbastecimentoController::relatorioAbastecimentoDiarioAction',));
        }

        // login
        if ($pathinfo === '/webloja') {
            return array (  '_controller' => 'webloja\\WeblojaBundle\\Controller\\LoginController::indexAction',  '_route' => 'login',);
        }

        // principal
        if ($pathinfo === '/home') {
            return array (  '_controller' => 'webloja\\WeblojaBundle\\Controller\\HomeController::indexAction',  '_route' => 'principal',);
        }

        // logout
        if ($pathinfo === '/logout') {
            return array (  '_controller' => 'webloja\\WeblojaBundle\\Controller\\HomeController::logoutAction',  '_route' => 'logout',);
        }

        // root
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'root');
            }

            return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'principal',  '_route' => 'root',);
        }

        // webloja_menu_interno
        if ($pathinfo === '/menu/principal/criar') {
            return array (  '_controller' => 'webloja\\WeblojaBundle\\Controller\\MenuController::criarMenuInternoAction',  '_route' => 'webloja_menu_interno',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
