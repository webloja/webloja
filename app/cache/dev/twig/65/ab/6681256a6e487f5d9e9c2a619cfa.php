<?php

/* menuNavCache1.html */
class __TwigTemplate_65ab6681256a6e487f5d9e9c2a619cfa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class = \"navbar\">
<div class = \"navbar-inner\">
<div class = \"container\">
<ul class = \"nav\">
<li><a href = \"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("principal"), "html", null, true);
        echo "\">Home</a></li>
<li class = \"dropdown\">
<a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\" >Admin<b class = \"caret\"></b></a>
<ul class=\"dropdown-menu\">
<li class=\"dropdown-submenu\">
<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown-submenu\">Gerenciamento Global</a>
<ul class=\"dropdown-menu\">
</ul>
</li>
<li class=\"dropdown-submenu\">
<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown-submenu\">Gerenciamento de Usuários</a>
<ul class=\"dropdown-menu\">
</ul>
</li>
<li class=\"dropdown-submenu\">
<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown-submenu\">Gerenciamento de Menu</a>
<ul class=\"dropdown-menu\">
<li><a href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("webloja_menu_interno", array("id_interno" => 1)), "html", null, true);
        echo "\">Criar Menu Principal</a></li>
</ul>
</li>
</ul>
</li>
<li class = \"dropdown\">
<a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\" >Opções<b class = \"caret\"></b></a>
<ul class=\"dropdown-menu\">
<li class=\"dropdown-submenu\">
<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown-submenu\">Preferências</a>
<ul class=\"dropdown-menu\">
</ul>
</li>
</ul>
</li>
</ul>
</div>
</div>
</div>";
    }

    public function getTemplateName()
    {
        return "menuNavCache1.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 22,  25 => 5,  19 => 1,);
    }
}
