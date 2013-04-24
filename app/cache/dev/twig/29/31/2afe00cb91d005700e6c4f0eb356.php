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
        echo "    </head>
    <body>
        <div id=\"wrapper\">
        ";
        // line 31
        $this->displayBlock('header', $context, $blocks);
        // line 54
        echo "                <header>
                ";
        // line 55
        $this->displayBlock('menuNav', $context, $blocks);
        // line 58
        echo "                </header>
                <div id=\"content\">
                   <div class=\"container-fluid\">
                       <div class=\"row-fluid\" >
                           <div class=\"span12\">
                            <br />
                            ";
        // line 64
        $this->displayBlock('body', $context, $blocks);
        // line 65
        echo "                           </div>
                       </div>
                    </div>
                 </div><!-- #content-->
        </div>
    ";
        // line 70
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
            \$(function(){
                \$('#myCarousel').carousel()
            })
        </script>
        ";
    }

    // line 31
    public function block_header($context, array $blocks = array())
    {
        // line 32
        echo "        <div class=\"row-fluid\">
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
            echo "                    <div></div>
               ";
        } else {
            // line 43
            echo "                    <div class='alert alert-error'>
                        ";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "boasVindas"), "method"), "html", null, true);
            echo "
                        <div class='text-right'>
                            <a href=\"logout\" class=\"btn btn-danger btn-mini\"><i class='icon-remove icon-white'></i>&nbsp;Sair</a>
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
        echo "                    ";
        $this->env->loadTemplate("::menuNav.html.twig")->display($context);
        echo "        
                ";
    }

    // line 64
    public function block_body($context, array $blocks = array())
    {
    }

    // line 70
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
        return array (  208 => 70,  203 => 64,  196 => 56,  185 => 49,  176 => 44,  169 => 41,  167 => 40,  156 => 35,  151 => 32,  148 => 31,  133 => 20,  129 => 19,  124 => 18,  121 => 17,  115 => 12,  111 => 11,  107 => 10,  103 => 9,  99 => 8,  96 => 7,  87 => 5,  78 => 70,  71 => 65,  69 => 64,  59 => 55,  56 => 54,  54 => 31,  49 => 28,  47 => 17,  38 => 13,  36 => 6,  32 => 5,  26 => 1,  331 => 140,  327 => 139,  323 => 138,  319 => 137,  315 => 136,  311 => 135,  307 => 134,  303 => 133,  299 => 132,  292 => 127,  288 => 125,  279 => 122,  274 => 121,  270 => 120,  267 => 119,  259 => 113,  257 => 112,  250 => 107,  246 => 105,  237 => 102,  232 => 101,  228 => 100,  225 => 99,  217 => 93,  215 => 92,  206 => 85,  202 => 83,  193 => 55,  188 => 79,  184 => 78,  181 => 77,  173 => 43,  171 => 70,  160 => 36,  150 => 58,  147 => 57,  143 => 56,  137 => 21,  122 => 41,  117 => 39,  113 => 38,  109 => 37,  105 => 36,  101 => 35,  97 => 34,  93 => 6,  89 => 32,  85 => 31,  77 => 25,  74 => 24,  65 => 21,  61 => 58,  55 => 19,  52 => 18,  44 => 13,  42 => 15,  31 => 3,  28 => 2,);
    }
}
