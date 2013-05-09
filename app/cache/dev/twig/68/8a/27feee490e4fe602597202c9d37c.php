<?php

/* WeblojaBundle:Home:principal.html.twig */
class __TwigTemplate_688a27feee490e4fe602597202c9d37c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::webloja.html.twig");

        $this->blocks = array(
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
    public function block_body($context, array $blocks = array())
    {
        // line 3
        echo "<div class=\"row-fluid\">
    <div class=\"span3\">
        <div class=\"row-fluid\">
            <div class=\"well well-small\"><strong>
                    <i class=\"icon-list\"></i>&nbsp;&nbsp;
                    &Uacute;ltimas Not&iacute;cias - DOL
                </strong>
            </div>
             <div>
                 ";
        // line 12
        if (twig_test_empty((isset($context["objNoticiaDol"]) ? $context["objNoticiaDol"] : $this->getContext($context, "objNoticiaDol")))) {
            // line 13
            echo "                     <div style=\"height: 200px;\">
                        <div class=\"alert alert-error\">
                            Nenhuma notícia encontrada!
                        </div>
                     </div>
                 ";
        } else {
            // line 18
            echo "    
                    ";
            // line 19
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["objNoticiaDol"]) ? $context["objNoticiaDol"] : $this->getContext($context, "objNoticiaDol")));
            foreach ($context['_seq'] as $context["_key"] => $context["noticiaDol"]) {
                echo "        
                        <label class='text-error'><strong>";
                // line 20
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["noticiaDol"]) ? $context["noticiaDol"] : $this->getContext($context, "noticiaDol")), "titulo"), "html", null, true);
                echo "</strong></label>
                        <label ><small><a href=\"#\">";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["noticiaDol"]) ? $context["noticiaDol"] : $this->getContext($context, "noticiaDol")), "mensagem"), "html", null, true);
                echo "</a></small></label>
                        <hr />                              
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['noticiaDol'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 24
            echo "                 ";
        }
        // line 25
        echo "             </div>
        </div>
        <div class=\"row-fluid\">
            <div class=\"well well-small text-center span12\">
                <strong>LINKS</strong>
                <hr />
                <span class='span3'><a href='http://flash' target='_blank' ><img border='0' src='";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/LogFlashR.jpg"), "html", null, true);
        echo "' alt='Flash'/></a></span>
                <span class='span4'><a href='http://lasanet/rdv/' target='_blank' ><img border='0' src='";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/RDV.jpg"), "html", null, true);
        echo "' alt='Relatório Diário de Vendas'/></a></span>
                <span class='span4'><a href='http://lasanet/rdv/' target='_blank' ><img border='0' src='";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/PortalBlock.jpg"), "html", null, true);
        echo "' alt='Portal Block/Express'/></a></span>
                <span class='span3'><a href='http://lista' target='_blank' ><img border='0' src='";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/Telefones.jpg"), "html", null, true);
        echo "' alt='Lista de Telefones'/></a></span>
                <span class='span4'><a href='http://catlasa' target='_blank' ><img border='0' src='";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/Cat_lasa.jpg"), "html", null, true);
        echo "' alt='CAT LASA'/></a></span>
                <span class='span4'><a href='http://epss/tesprod/asp/login.asp' target='_blank' ><img border='0' src='";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/Tesouraria.jpg"), "html", null, true);
        echo "' alt='Tesouraria'/></a></span>
                <span class='span3'><a href='http://lasanet:8002/lasa/calandra.nsf/paginas/previsao' target='_blank' ><img border='0' src='";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/tempo.jpg"), "html", null, true);
        echo "' alt='Previsão do Tempo'/></a></span>
                <span class='span4'><a href='https://mail.b2winc.com/owa/' target='_blank' ><img border='0' src='";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/Outlook.jpg"), "html", null, true);
        echo "' alt='Email'/></a></span>
                <span class='span4'><a href='https://sistemas.spotpromo.com.br/webo/login.aspx' target='_blank' ><img border='0' src='";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/promotores.jpg"), "html", null, true);
        echo "' alt='Promotores'/></a></span>
                <span class='span3'></span>
                <span class='span4'><a href='http://reversadhc/default.aspx' target='_blank' ><img border='0' src='";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/LogLogisticaReversa.jpg"), "html", null, true);
        echo "' alt='Logística Reversa'/></a></span>
                <span class='span3'></span>
            </div>
            <p class='muted' style='height: 200px;'></p>
                </div>   
            </div>
            <div class=\"span6\">
            <div class=\"row-fluid\"><center>
              <div id=\"myCarousel\" class=\"carousel slide\">
                <div class=\"carousel-inner\">
                    
                  <div class=\"active item\">
                    <img src=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/bannerInicio.jpg"), "html", null, true);
        echo "\" />
                  </div>

                  ";
        // line 56
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["objBanner"]) ? $context["objBanner"] : $this->getContext($context, "objBanner")));
        foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
            // line 57
            echo "                  <div class=\"item\">
                    <img src=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/marketing/"), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["banner"]) ? $context["banner"] : $this->getContext($context, "banner")), "arquivo"), "html", null, true);
            echo "\" alt=\"\">
                  </div>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 61
        echo "                </div>
                </div>
                </center>
             </div>
                <div class=\"row-fluid\">
                    <div class=\"well well-small\">
                        <i class=\"icon-list\"></i>&nbsp;&nbsp;
                        <strong>Plant&atilde;o - Marketing</strong>
                    </div>
                   ";
        // line 70
        if (twig_test_empty((isset($context["objMarketing"]) ? $context["objMarketing"] : $this->getContext($context, "objMarketing")))) {
            // line 71
            echo "                     <div style=\"height: 200px;\">
                        <div class=\"alert alert-error\">
                            Nenhuma notificação encontrada!
                        </div>
                     </div>
                    ";
        } else {
            // line 77
            echo "                    <div>
                        ";
            // line 78
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["objMarketing"]) ? $context["objMarketing"] : $this->getContext($context, "objMarketing")));
            foreach ($context['_seq'] as $context["_key"] => $context["marketing"]) {
                // line 79
                echo "                        <label class='text-error'><strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["marketing"]) ? $context["marketing"] : $this->getContext($context, "marketing")), "titulo"), "html", null, true);
                echo "</strong></label>
                        <label ><small><a href=\"#\">";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["marketing"]) ? $context["marketing"] : $this->getContext($context, "marketing")), "mensagem"), "html", null, true);
                echo "</a></small></label>
                        <hr />
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['marketing'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 83
            echo "                    </div>
                    ";
        }
        // line 85
        echo "                </div> 
            </div>
            <div class=\"span3\">
                <div class=\"row-fluid\">
                    <div class=\"well well-small\">
                    <i class=\"icon-list\"></i>&nbsp;&nbsp;
                    <strong>Notifica&ccedil;&otilde;es Diversas</strong></div>
                    ";
        // line 92
        if (twig_test_empty((isset($context["objNotificacao"]) ? $context["objNotificacao"] : $this->getContext($context, "objNotificacao")))) {
            // line 93
            echo "                     <div style=\"height: 200px;\">
                        <div class=\"alert alert-error\">
                            Nenhuma notificação encontrada!
                        </div>
                     </div>
                    ";
        } else {
            // line 99
            echo "                    <div>
                        ";
            // line 100
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["objNotificacao"]) ? $context["objNotificacao"] : $this->getContext($context, "objNotificacao")));
            foreach ($context['_seq'] as $context["_key"] => $context["notificacao"]) {
                // line 101
                echo "                        <label class='text-error'><strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["notificacao"]) ? $context["notificacao"] : $this->getContext($context, "notificacao")), "titulo"), "html", null, true);
                echo "</strong></label>
                        <label ><small><a href=\"#\">";
                // line 102
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["notificacao"]) ? $context["notificacao"] : $this->getContext($context, "notificacao")), "mensagem"), "html", null, true);
                echo "</a></small></label>
                        <hr />
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notificacao'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 105
            echo "                    </div>
                    ";
        }
        // line 107
        echo "                </div>
                <div class=\"row-fluid\">
                    <div class=\"well well-small\">
                    <i class=\"icon-list\"></i>&nbsp;&nbsp;
                    <strong>Plant&atilde;o - Merchandising</strong></div>
                     ";
        // line 112
        if (twig_test_empty((isset($context["objMerchandising"]) ? $context["objMerchandising"] : $this->getContext($context, "objMerchandising")))) {
            // line 113
            echo "                     <div style=\"height: 200px;\">
                        <div class=\"alert alert-error\">
                            Nenhuma notificação encontrada!
                        </div>
                     </div>
                    ";
        } else {
            // line 119
            echo "                    <div>
                        ";
            // line 120
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["objMerchandising"]) ? $context["objMerchandising"] : $this->getContext($context, "objMerchandising")));
            foreach ($context['_seq'] as $context["_key"] => $context["merchandising"]) {
                // line 121
                echo "                        <label class='text-error'><strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["merchandising"]) ? $context["merchandising"] : $this->getContext($context, "merchandising")), "titulo"), "html", null, true);
                echo "</strong></label>
                        <label ><small><a href=\"#\">";
                // line 122
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["merchandising"]) ? $context["merchandising"] : $this->getContext($context, "merchandising")), "mensagem"), "html", null, true);
                echo "</a></small></label>
                        <hr />
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['merchandising'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 125
            echo "                    </div>
                        ";
        }
        // line 127
        echo "                </div>  
            </div>
        </div>
        <div class=\"row-fluid\">
            <div class=\"span12 text-center\">
                <a href=\"http://www.b2winc.com/\" target='_blank'><img src=\"";
        // line 132
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_b2w.png"), "html", null, true);
        echo "\" /></a>
                <a href=\"http://www.americanas.com.br/\" target='_blank'><img src=\"";
        // line 133
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_americanascom.png"), "html", null, true);
        echo "\" /></a>
                <a href=\"http://www.submarino.com.br/\" target='_blank'><img src=\"";
        // line 134
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_submarino.png"), "html", null, true);
        echo "\" /></a>
                <a href=\"http://www.shoptime.com.br/\" target='_blank'><img src=\"";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_shoptime.png"), "html", null, true);
        echo "\" /></a>
                <a href=\"http://www.americanastaii.com.br/\" target='_blank'><img src=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_fai.png"), "html", null, true);
        echo "\" /></a>
                <a href=\"http://www.ingresso.com.br\" target='_blank'><img src=\"";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_ingressocom.png"), "html", null, true);
        echo "\" /></a>
                <a href=\"http://ri.lasa.com.br\" target='_blank'><img src=\"";
        // line 138
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_ri.png"), "html", null, true);
        echo "\" /></a>
                <a href=\"http://www.blockbusteronline.com.br/acom/index.htm?chave=home_ban_blockbuster&WT.mc_id=MKTG003571&WT.mc_ev=click\" target='_blank'><img src=\"";
        // line 139
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_blockbuster.png"), "html", null, true);
        echo "\" /></a>
                <img src=\"";
        // line 140
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webloja/images/logo_cia_verde.png"), "html", null, true);
        echo "\" />
            </div>
        </div>
";
    }

    public function getTemplateName()
    {
        return "WeblojaBundle:Home:principal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  331 => 140,  327 => 139,  323 => 138,  319 => 137,  315 => 136,  311 => 135,  307 => 134,  303 => 133,  299 => 132,  292 => 127,  288 => 125,  279 => 122,  274 => 121,  270 => 120,  267 => 119,  259 => 113,  257 => 112,  250 => 107,  246 => 105,  237 => 102,  232 => 101,  228 => 100,  225 => 99,  217 => 93,  215 => 92,  206 => 85,  202 => 83,  193 => 80,  188 => 79,  184 => 78,  181 => 77,  173 => 71,  171 => 70,  160 => 61,  150 => 58,  147 => 57,  143 => 56,  137 => 53,  122 => 41,  117 => 39,  113 => 38,  109 => 37,  105 => 36,  101 => 35,  97 => 34,  93 => 33,  89 => 32,  85 => 31,  77 => 25,  74 => 24,  65 => 21,  61 => 20,  55 => 19,  52 => 18,  44 => 13,  42 => 12,  31 => 3,  28 => 2,);
    }
}
