<?php

/* WeblojaBundle:Menu:form_menu_interno.html.twig */
class __TwigTemplate_9835d5df9d968d61228120f86ed3149b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("webloja.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "webloja.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo " Criar Menu Interno - WebLoja! ";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        echo " 
<div class=\"row-fluid\"> 
    <div class=\"span3\"></div>
    <div class='span6'>
        <div class=\"well well-small\">
            <form class=\"form-horizontal\" action=\"webloja\" method=\"post\" ";
        // line 10
        echo ">       
                <div class=\"control-group\">
                    <div class=\"controls text-center\">
                        <label class=\"control-label\"><strong>&Aacute;rea Restrita</strong></label>
                    </div>
                </div>
                ";
        // line 17
        echo "                <hr />

                <div class=\"control-group\">
                    <label for=\"\">Titulo</label>

                    <div class=\"controls\">
                         <input type=\"text\" class=\"input-xlarge\" />
                    </div>
                </div>

                <div class=\"control-group\">
                    <label for=\"\">Ordem</label>

                    <div class=\"controls\">
                        <input type=\"number\" class=\"input-large\" />
                    </div>
                </div>

                 <div class=\"control-group\">
                    <label for=\"\">Permissão</label>

                    <div class=\"controls\">
                        <input type=\"text\" class=\"input-large\" />
                    </div>
                </div>

                <div class=\"control-group\">
                    <label for=\"\">Rota</label>

                    <div class=\"controls\">
                        <input type=\"text\" class=\"input-large\" />
                    </div>
                </div>

                 <div class=\"control-group\">
                    <label for=\"\" class=\"control-label\">Menu</label>

                    <div class=\"controls\">
                        <select>
                            <option value=\"\">Selecione...</option>
                        </select>
                    </div>
                </div>

                <div class=\"control-group\">
                    <label for=\"\">Menu pai</label>

                    <div class=\"controls\">
                        <select>
                            <option value=\"\">Selecione...</option>
                        </select>
                    </div>
                </div>

                <div class=\"control-group\">
                    <div class=\"controls\">
                      <label class=\"checkbox\">
                          <input type=\"radio\" value=\"1\" name=\"chkStatus\" checked=\"checked\" />Ativo
                          <input type=\"radio\" value=\"0\" name=\"chkStatus\" />Inativo
                      </label>
                    </div>
                </div>
            </form>
        </div>
    ";
        // line 81
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => "notice"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 82
            echo "        <div class=\"alert alert-error\">
            ";
            // line 83
            echo twig_escape_filter($this->env, (isset($context["flashMessage"]) ? $context["flashMessage"] : $this->getContext($context, "flashMessage")), "html", null, true);
            echo "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 86
        echo "        
    </div>
    
    <div class='span3'></div>
</div>

";
    }

    public function getTemplateName()
    {
        return "WeblojaBundle:Menu:form_menu_interno.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 86,  125 => 83,  122 => 82,  118 => 81,  52 => 17,  44 => 10,  35 => 5,  29 => 3,);
    }
}
