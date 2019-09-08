<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /themes/custom/shopZ/templates/pages/includes/site_header.html.twig */
class __TwigTemplate_2064600f23d4c7cff56e3b332a0f40f30ee0f8dafaf2b3c58eccccb040abbcdb extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 2, "if" => 5];
        $filters = ["escape" => 14, "t" => 15];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 't'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 2
        $context["site_logo_url"] = (($this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)) . $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null))) . "/gfx/logo.png");
        // line 3
        echo "
";
        // line 5
        if ($this->getAttribute(($context["page"] ?? null), "mobile_nav", [])) {
            // line 6
            echo "  ";
            if ($this->getAttribute(($context["page"] ?? null), "site_search", [])) {
                // line 7
                echo "    <div class=\"mobile-overlay mobile-search-overlay\">
      <div class=\"mobile-search-overlay__content mobile-overlay__content\">
        <a href=\"#\" class=\"mobile-search-overlay__close mobile-overlay__close\">
          <span class=\"fa fa-times\" aria-hidden=\"true\"></span>
        </a>

        <div class=\"mobile-search-form\">
          ";
                // line 14
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "site_search", [])), "html", null, true);
                echo "
          <a class=\"mobile-search-form__submit\" href=\"#\" title=\"";
                // line 15
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Search"));
                echo "\">
            <span class=\"fa fa-search\" aria-hidden=\"true\"></span>
          </a>
        </div>
      </div>
    </div>
  ";
            }
            // line 22
            echo "
  <div class=\"mobile-overlay mobile-nav-overlay\">
    <div class=\"mobile-nav-overlay__content mobile-overlay__content clearfix\">
      <header class=\"mobile-nav-overlay__header clearfix\" role=\"banner\">
        <a href=\"#\" class=\"mobile-nav-overlay__close mobile-overlay__close\">
          <span class=\"fa fa-times\" aria-hidden=\"true\"></span>
        </a>
      </header>

      <div class=\"mobile-nav\">
        ";
            // line 32
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "mobile_nav", [])), "html", null, true);
            echo "
      </div>
    </div>
  </div>
";
        }
        // line 38
        echo "
<header class=\"site-header\">
  ";
        // line 41
        echo "  <div class=\"site-header__top-bar\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12 col-lg-6 site-header__top-bar--left\">
          ";
        // line 45
        if ($this->getAttribute(($context["page"] ?? null), "header_promo", [])) {
            // line 46
            echo "            ";
            // line 47
            echo "            <div class=\"site-header__promo\">
              ";
            // line 48
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header_promo", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 51
        echo "        </div>

        <div class=\"hidden-xs col-md-12 col-lg-6 site-header__top-bar--right\">
          ";
        // line 54
        if ($this->getAttribute(($context["page"] ?? null), "header_nav", [])) {
            // line 55
            echo "            ";
            // line 56
            echo "            <div class=\"site-header-nav\">
              ";
            // line 57
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header_nav", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 60
        echo "
          ";
        // line 61
        if ($this->getAttribute(($context["page"] ?? null), "language_select", [])) {
            // line 62
            echo "            ";
            // line 63
            echo "            <div class=\"site-header__language-select\">
              ";
            // line 64
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "language_select", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 67
        echo "        </div>
      </div>
    </div>
  </div>

  ";
        // line 73
        echo "  <div class=\"site-header__top container\">
    <div class=\"row\">
      <div class=\"col-xs-8 col-sm-5 col-md-5\">
        ";
        // line 77
        echo "        <div class=\"site-header__logo\">
          <a href=\"";
        // line 78
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["front_page"] ?? null)), "html", null, true);
        echo "\">
            <img src=\"";
        // line 79
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["site_logo_url"] ?? null)), "html", null, true);
        echo "\" alt=\"";
        ((($context["site_name"] ?? null)) ? (print ($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["site_name"] ?? null), "html", null, true))) : (print ("")));
        echo "\" />
          </a>
        </div>
      </div>

      <div class=\"col-xs-4 col-sm-7 col-md-7 site-header__main\">
        <div class=\"hidden-xs site-header__main-left\">
          ";
        // line 87
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 88
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
            echo "
          ";
        }
        // line 90
        echo "        </div>

        <div class=\"hidden-xs site-header__main-right\">
          ";
        // line 94
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "header_right", [])) {
            // line 95
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header_right", [])), "html", null, true);
            echo "
          ";
        }
        // line 97
        echo "\t\t  ";
        // line 98
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "site_search", [])) {
            // line 99
            echo "          <div class=\"hidden-xs site-header__search\">
            ";
            // line 100
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "site_search", [])), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 103
        echo "        </div>

        ";
        // line 106
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "mobile_nav", [])) {
            // line 107
            echo "          <div class=\"mobile-control-nav visible-xs-block\">
            <ul class=\"menu clearfix\">
              <li class=\"menu__item menu__item--search\">
                <a href=\"#\" class=\"menu__link\" title=\"";
            // line 110
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Search"));
            echo "\">
                  <span aria-hidden=\"true\" class=\"fa fa-search\"></span>
                </a>
              </li>
              <li class=\"menu__item menu__item--menu\">
                <a href=\"#\" class=\"menu__link\" title=\"";
            // line 115
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Menu"));
            echo "\">
                  <span aria-hidden=\"true\" class=\"fa fa-bars\"></span>
                </a>
              </li>
            </ul>
          </div>
        ";
        }
        // line 122
        echo "        ";
        // line 123
        echo "

      </div>
    </div>
  </div>

  ";
        // line 130
        echo "  <div class=\"site-header__bottom\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          ";
        // line 134
        if ($this->getAttribute(($context["page"] ?? null), "primary_nav", [])) {
            // line 135
            echo "           ";
            // line 136
            echo "            <div class=\"primary-nav hidden-xs\">
              ";
            // line 137
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "primary_nav", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 140
        echo "        </div>
      </div>
    </div>
  </div>
</header>
";
    }

    public function getTemplateName()
    {
        return "/themes/custom/shopZ/templates/pages/includes/site_header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  292 => 140,  286 => 137,  283 => 136,  281 => 135,  279 => 134,  273 => 130,  265 => 123,  263 => 122,  253 => 115,  245 => 110,  240 => 107,  237 => 106,  233 => 103,  227 => 100,  224 => 99,  221 => 98,  219 => 97,  213 => 95,  210 => 94,  205 => 90,  199 => 88,  196 => 87,  184 => 79,  180 => 78,  177 => 77,  172 => 73,  165 => 67,  159 => 64,  156 => 63,  154 => 62,  152 => 61,  149 => 60,  143 => 57,  140 => 56,  138 => 55,  136 => 54,  131 => 51,  125 => 48,  122 => 47,  120 => 46,  118 => 45,  112 => 41,  108 => 38,  100 => 32,  88 => 22,  78 => 15,  74 => 14,  65 => 7,  62 => 6,  60 => 5,  57 => 3,  55 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{# Set the path for the site logo. #}
{% set site_logo_url =  base_path ~ directory ~ '/gfx/logo.png' %}

{# Mobile overlays. #}
{% if page.mobile_nav %}
  {% if page.site_search %}
    <div class=\"mobile-overlay mobile-search-overlay\">
      <div class=\"mobile-search-overlay__content mobile-overlay__content\">
        <a href=\"#\" class=\"mobile-search-overlay__close mobile-overlay__close\">
          <span class=\"fa fa-times\" aria-hidden=\"true\"></span>
        </a>

        <div class=\"mobile-search-form\">
          {{ page.site_search }}
          <a class=\"mobile-search-form__submit\" href=\"#\" title=\"{{ 'Search'|t }}\">
            <span class=\"fa fa-search\" aria-hidden=\"true\"></span>
          </a>
        </div>
      </div>
    </div>
  {% endif %}

  <div class=\"mobile-overlay mobile-nav-overlay\">
    <div class=\"mobile-nav-overlay__content mobile-overlay__content clearfix\">
      <header class=\"mobile-nav-overlay__header clearfix\" role=\"banner\">
        <a href=\"#\" class=\"mobile-nav-overlay__close mobile-overlay__close\">
          <span class=\"fa fa-times\" aria-hidden=\"true\"></span>
        </a>
      </header>

      <div class=\"mobile-nav\">
        {{ page.mobile_nav }}
      </div>
    </div>
  </div>
{% endif %}
{# / Mobile overlays. #}

<header class=\"site-header\">
  {# Header top bar. #}
  <div class=\"site-header__top-bar\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12 col-lg-6 site-header__top-bar--left\">
          {% if page.header_promo %}
            {# Header promo area. #}
            <div class=\"site-header__promo\">
              {{ page.header_promo }}
            </div>
          {% endif %}
        </div>

        <div class=\"hidden-xs col-md-12 col-lg-6 site-header__top-bar--right\">
          {% if page.header_nav %}
            {# Header navigation. #}
            <div class=\"site-header-nav\">
              {{ page.header_nav }}
            </div>
          {% endif %}

          {% if page.language_select %}
            {# Language select. #}
            <div class=\"site-header__language-select\">
              {{ page.language_select }}
            </div>
          {% endif %}
        </div>
      </div>
    </div>
  </div>

  {# Header main. #}
  <div class=\"site-header__top container\">
    <div class=\"row\">
      <div class=\"col-xs-8 col-sm-5 col-md-5\">
        {# Logo. #}
        <div class=\"site-header__logo\">
          <a href=\"{{ front_page }}\">
            <img src=\"{{ site_logo_url }}\" alt=\"{{ site_name ? site_name }}\" />
          </a>
        </div>
      </div>

      <div class=\"col-xs-4 col-sm-7 col-md-7 site-header__main\">
        <div class=\"hidden-xs site-header__main-left\">
          {# Contact info. #}
          {% if page.header %}
            {{ page.header }}
          {% endif %}
        </div>

        <div class=\"hidden-xs site-header__main-right\">
          {# Cart. #}
          {% if page.header_right %}
            {{ page.header_right }}
          {% endif %}
\t\t  {# Site search. #}
        {% if page.site_search %}
          <div class=\"hidden-xs site-header__search\">
            {{ page.site_search }}
          </div>
        {% endif %}
        </div>

        {# Mobile navigation. #}
        {% if page.mobile_nav %}
          <div class=\"mobile-control-nav visible-xs-block\">
            <ul class=\"menu clearfix\">
              <li class=\"menu__item menu__item--search\">
                <a href=\"#\" class=\"menu__link\" title=\"{{ 'Search'|t }}\">
                  <span aria-hidden=\"true\" class=\"fa fa-search\"></span>
                </a>
              </li>
              <li class=\"menu__item menu__item--menu\">
                <a href=\"#\" class=\"menu__link\" title=\"{{ 'Menu'|t }}\">
                  <span aria-hidden=\"true\" class=\"fa fa-bars\"></span>
                </a>
              </li>
            </ul>
          </div>
        {% endif %}
        {# / Mobile navigation. #}


      </div>
    </div>
  </div>

  {# Header bottom. #}
  <div class=\"site-header__bottom\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          {% if page.primary_nav %}
           {# Primary navigation. #}
            <div class=\"primary-nav hidden-xs\">
              {{ page.primary_nav }}
            </div>
          {% endif %}
        </div>
      </div>
    </div>
  </div>
</header>
", "/themes/custom/shopZ/templates/pages/includes/site_header.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/pages/includes/site_header.html.twig");
    }
}
