<?php

/* ::menuNav.html.twig */
class __TwigTemplate_ed049f7a5a9cbcc41590c9b1aa489471 extends Twig_Template
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
        echo "<div class=\"navbar\">
    <div class=\"navbar-inner\">
        <div class=\"container\">
            <div class=\"nav-collapse collapse navbar-responsive-collapse\">
                <ul class=\"nav\">
                    <li><a href=\"home\">Home</a></li>
                    <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">DOL <b class=\"caret\"></b></a>
                        <ul class=\"dropdown-menu\">
                            <li><a href=\"#\">Link</a></li>
                            <li><a href=\"#\">Link</a></li>
                            <li><a href=\"#\">Link</a></li>
                            <li class=\"divider\"></li>
                            <li class=\"nav-header\">Parte 2 do menu</li>
                            <li><a href=\"#\">Link</a></li>
                            <li><a href=\"#\">Link</a></li>
                            <li class=\"dropdown-submenu\">
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown-submenu\">Fornecedores</a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"#\">Listar Fornecedores</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--<form class=\"navbar-search pull-left\" action=\"\">
                    <input type=\"text\" class=\"search-query span2\" placeholder=\"Search\">
                </form>-->
                <!--<ul class=\"nav pull-right\">
                    <li><a href=\"#\">Link</a></li>
                    <li class=\"divider-vertical\"></li>
                    <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Dropdown <b class=\"caret\"></b></a>
                        <ul class=\"dropdown-menu\">
                            <li><a href=\"#\">Action</a></li>
                            <li><a href=\"#\">Another action</a></li>
                            <li><a href=\"#\">Something else here</a></li>
                            <li class=\"divider\"></li>
                            <li><a href=\"#\">Separated link</a></li>
                        </ul>
                    </li>
                </ul>-->
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div><br />
";
    }

    public function getTemplateName()
    {
        return "::menuNav.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
