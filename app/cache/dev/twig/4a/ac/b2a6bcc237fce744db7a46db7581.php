<?php

/* @WebProfiler/Profiler/base_js.html.twig */
class __TwigTemplate_4aacb2a6bcc237fce744db7a46db7581 extends Twig_Template
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
        echo "<script type=\"text/javascript\">/*<![CDATA[*/
    Sfjs = (function() {
        \"use strict\";

        var noop = function() {},

            profilerStorageKey = 'sf2/profiler/',

            request = function(url, onSuccess, onError, payload, options) {
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                options = options || {};
                xhr.open(options.method || 'GET', url, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onreadystatechange = function(state) {
                    if (4 === xhr.readyState && 200 === xhr.status) {
                        (onSuccess || noop)(xhr);
                    } else if (4 === xhr.readyState && xhr.status != 200) {
                        (onError || noop)(xhr);
                    }
                };
                xhr.send(payload || '');
            },

            hasClass = function(el, klass) {
                return el.className.match(new RegExp('\\\\b' + klass + '\\\\b'));
            },

            removeClass = function(el, klass) {
                el.className = el.className.replace(new RegExp('\\\\b' + klass + '\\\\b'), ' ');
            },

            addClass = function(el, klass) {
                if (!hasClass(el, klass)) { el.className += \" \" + klass; }
            },

            getPreference = function(name) {
                if (!window.localStorage) {
                    return null;
                }

                return localStorage.getItem(profilerStorageKey + name);
            },

            setPreference = function(name, value) {
                if (!window.localStorage) {
                    return null;
                }

                localStorage.setItem(profilerStorageKey + name, value);
            };

        return {
            hasClass: hasClass,

            removeClass: removeClass,

            addClass: addClass,

            getPreference: getPreference,

            setPreference: setPreference,

            request: request,

            load: function(selector, url, onSuccess, onError, options) {
                var el = document.getElementById(selector);

                if (el && el.getAttribute('data-sfurl') !== url) {
                    request(
                        url,
                        function(xhr) {
                            el.innerHTML = xhr.responseText;
                            el.setAttribute('data-sfurl', url);
                            removeClass(el, 'loading');
                            (onSuccess || noop)(xhr, el);
                        },
                        function(xhr) { (onError || noop)(xhr, el); },
                        options
                    );
                }

                return this;
            },

            toggle: function(selector, elOn, elOff) {
                var i,
                    style,
                    tmp = elOn.style.display,
                    el = document.getElementById(selector);

                elOn.style.display = elOff.style.display;
                elOff.style.display = tmp;

                if (el) {
                    el.style.display = 'none' === tmp ? 'none' : 'block';
                }

                return this;
            }
        }
    })();
/*]]>*/</script>
";
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Profiler/base_js.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  91 => 35,  83 => 30,  79 => 29,  75 => 28,  70 => 26,  66 => 25,  62 => 24,  50 => 15,  46 => 14,  30 => 5,  24 => 2,  19 => 1,  208 => 70,  203 => 64,  196 => 56,  185 => 49,  176 => 44,  169 => 41,  167 => 40,  156 => 35,  151 => 32,  148 => 31,  133 => 20,  129 => 19,  124 => 18,  121 => 17,  115 => 12,  111 => 11,  107 => 10,  103 => 9,  99 => 8,  96 => 7,  87 => 5,  78 => 70,  71 => 65,  69 => 64,  59 => 55,  56 => 54,  54 => 31,  49 => 28,  47 => 17,  38 => 13,  36 => 6,  32 => 6,  26 => 3,  331 => 140,  327 => 139,  323 => 138,  319 => 137,  315 => 136,  311 => 135,  307 => 134,  303 => 133,  299 => 132,  292 => 127,  288 => 125,  279 => 122,  274 => 121,  270 => 120,  267 => 119,  259 => 113,  257 => 112,  250 => 107,  246 => 105,  237 => 102,  232 => 101,  228 => 100,  225 => 99,  217 => 93,  215 => 92,  206 => 85,  202 => 83,  193 => 55,  188 => 79,  184 => 78,  181 => 77,  173 => 43,  171 => 70,  160 => 36,  150 => 58,  147 => 57,  143 => 56,  137 => 21,  122 => 41,  117 => 39,  113 => 38,  109 => 37,  105 => 36,  101 => 35,  97 => 34,  93 => 6,  89 => 32,  85 => 31,  77 => 25,  74 => 24,  65 => 21,  61 => 58,  55 => 19,  52 => 18,  44 => 13,  42 => 12,  31 => 3,  28 => 2,);
    }
}
