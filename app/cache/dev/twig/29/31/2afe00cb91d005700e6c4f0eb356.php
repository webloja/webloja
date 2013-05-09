<?php

/* ::webloja.html.twig */
class __TwigTemplate_29312afe00cb91d005700e6c4f0eb356 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'header' => array($this, 'block_header'),
            'menuNav' => array($this, 'block_menuNav'),
            'body' => array($this, 'block_body'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo " 

        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />

        ";
        // line 17
        $this->displayBlock('javascripts', $context, $blocks);
        // line 28
        echo "        </head>
        <body>
            <div id=\"wrapper\">
        ";
        // line 31
        $this->displayBlock('header', $context, $blocks);
        // line 54
        echo "                            <header>
                ";
        // line 55
        $this->displayBlock('menuNav', $context, $blocks);
        // line 58
        echo "                                </header>
                                <div id=\"content\">
                                    <div class=\"container-fluid\">
                                        <div class=\"row-fluid\" >
                                            <div class=\"span12\">
                                                ";
        // line 63
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "id_interno"), "method")) {
            // line 64
            echo "                                                <ul class='breadcrumb'>
                                                    <li><i class='icon-chevron-right'></i>&nbsp;<strong>";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "menu"), "method"), "html", null, true);
            echo "</strong><span class='divider'>/</span></li>
                                                    <li class='text-error'><strong>";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "titulo"), "method"), "html", null, true);
            echo "</strong></li>
                                                </ul>
                                                ";
        }
        // line 69
        echo "                            ";
        $this->displayBlock('body', $context, $blocks);
        // line 70
        echo "                                            </div>
                                        </div>
                                    </div>
                                </div><!-- #content-->
                            </div>
    ";
        // line 75
        $this->displayBlock('footer', $context, $blocks);
        echo "    
                        </body>
                    </html>

";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "WebLoja";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "
        <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/css/bootstrap.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/css/bootstrap-responsive.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/css/theme.blue.css"), "html", null, true);
        echo "\">
        <link class=\"ui-theme\" rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/css/theme.jui.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/css/style.css"), "html", null, true);
        echo "\">
        ";
    }

    // line 17
    public function block_javascripts($context, array $blocks = array())
    {
        // line 18
        echo "        <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/js/jquery.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/js/bootstrap.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/js/jquery.tablesorter.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/js/jquery.tablesorter.widgets.js"), "html", null, true);
        echo "\"></script>
        <script>
            \$(function() {
                \$('#myCarousel').carousel()
            })
            </script>
        ";
    }

    // line 31
    public function block_header($context, array $blocks = array())
    {
        // line 32
        echo "                    <div class=\"row-fluid\">
                        <div class='header'>
                            <div class=\"span4\" style='margin-top: 10px;'>
                                &nbsp;&nbsp;<img src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/header_logo.jpg"), "html", null, true);
        echo "\" />
                                &nbsp;&nbsp;<img style='width: 65px; height: 65px; ' src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/webLoja.png"), "html", null, true);
        echo "\" /> 
                            </div>
                            <div class=\"span5\"></div>
                            <div class=\"span3\" style=\"margin-top: 10px;\">                         
               ";
        // line 40
        if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "id_user"), "method"))) {
            // line 41
            echo "                                    <div></div>
               ";
        } else {
            // line 43
            echo "                                    <div class='alert alert-error'>
                        ";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "boasVindas"), "method"), "html", null, true);
            echo "
                                            <div class='text-right'>
                                                <a href=\"";
            // line 46
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("logout"), "html", null, true);
            echo "\" class=\"btn btn-danger btn-mini\"><i class='icon-remove icon-white'></i>&nbsp;Sair</a>
                                            </div>    
                                        </div>
               ";
        }
        // line 49
        echo "                    
                                    </div>
                                </div>
                            </div>
        ";
    }

    // line 55
    public function block_menuNav($context, array $blocks = array())
    {
        // line 56
        echo "                     ";
        echo twig_escape_filter($this->env, twig_include($this->env, $context, (("menuNavCache" . $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "id_perfil"), "method")) . ".html")), "html", null, true);
        echo "
                ";
    }

    // line 69
    public function block_body($context, array $blocks = array())
    {
    }

    // line 75
    public function block_footer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::webloja.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 75,  221 => 69,  214 => 56,  211 => 55,  203 => 49,  196 => 46,  191 => 44,  188 => 43,  184 => 41,  182 => 40,  175 => 36,  171 => 35,  166 => 32,  163 => 31,  152 => 21,  148 => 20,  144 => 19,  139 => 18,  136 => 17,  130 => 12,  126 => 11,  122 => 10,  118 => 9,  114 => 8,  111 => 7,  108 => 6,  102 => 5,  93 => 75,  86 => 70,  77 => 66,  73 => 65,  70 => 64,  68 => 63,  61 => 58,  59 => 55,  54 => 31,  49 => 28,  47 => 17,  42 => 15,  36 => 6,  32 => 5,  26 => 1,  116 => 43,  107 => 40,  104 => 39,  100 => 38,  89 => 30,  83 => 69,  78 => 25,  71 => 21,  66 => 19,  60 => 16,  56 => 54,  52 => 14,  43 => 8,  38 => 13,  35 => 4,  29 => 2,);
    }
}
