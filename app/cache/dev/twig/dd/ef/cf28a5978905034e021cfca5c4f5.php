<?php

/* weblojaBundle:Home:index.html.twig */
class __TwigTemplate_ddefcf28a5978905034e021cfca5c4f5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::webloja.html.twig");

        $this->blocks = array(
            'menuNav' => array($this, 'block_menuNav'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::webloja.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_menuNav($context, array $blocks = array())
    {
        echo " ";
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "<div class='span4'></div>
<div class='span4'>
    <div class=\"well well-small\" style='margin-top: 160px;'>
        <form action=\"webloja\" method=\"post\" ";
        // line 8
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo ">       
            <div class=\"control-group\">
                <div class=\"controls text-center\">
                    <label class=\"control-label\"><strong>&Aacute;rea Restrita</strong></label>
                </div>
            </div>
                ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
            <div class=\"text-exception\" style=\"color: red;\">";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "login"), 'errors');
        echo "</div>
            <div class=\"text-exception\" style=\"color: red;\">";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "senha"), 'errors');
        echo "</div>
            <hr />
            <div class=\"control-group\">
                    ";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "login"), 'label', array("label_attr" => array("class" => "span3"), "label" => "Login"));
        echo "
                    <div class=\"controls\"> 
                    ";
        // line 21
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "login"), 'widget', array("attr" => array("class" => "span8")));
        echo "
                        </div>
                    </div>
                    <div class=\"control-group\">
                ";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "senha"), 'label', array("label_attr" => array("class" => "span3"), "label" => "Senha"));
        echo "
                            <div class=\"controls\">
                    ";
        // line 27
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "senha"), 'widget', array("attr" => array("class" => "span8")));
        echo "
                                </div>
                            </div>
            ";
        // line 30
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
                            <div class=\"control-group\">
                                <div class=\"controls text-center\">
                                    <button type=\"submit\" class=\"btn btn-danger\">Entrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                ";
        // line 38
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => "notice"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 39
            echo "                <div class=\"alert alert-error\">
                        ";
            // line 40
            echo twig_escape_filter($this->env, (isset($context["flashMessage"]) ? $context["flashMessage"] : $this->getContext($context, "flashMessage")), "html", null, true);
            echo "
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 43
        echo "</div>
<div class='span4'></div>
";
    }

    public function getTemplateName()
    {
        return "weblojaBundle:Home:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 43,  107 => 40,  104 => 39,  100 => 38,  89 => 30,  83 => 27,  78 => 25,  71 => 21,  66 => 19,  60 => 16,  56 => 15,  52 => 14,  43 => 8,  38 => 5,  35 => 4,  29 => 2,);
    }
}
