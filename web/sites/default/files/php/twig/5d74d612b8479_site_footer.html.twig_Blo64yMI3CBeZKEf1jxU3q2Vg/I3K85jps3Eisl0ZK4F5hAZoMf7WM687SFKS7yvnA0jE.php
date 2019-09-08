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

/* /themes/custom/shopZ/templates/pages/includes/site_footer.html.twig */
class __TwigTemplate_82c257571cd545f6251c39c22f3c8d03eb5d21f8b0c35d8e055f39a132a3169f extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 2, "if" => 19];
        $filters = ["escape" => 13];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
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
        $context["site_logo_icon_url"] = (($this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)) . $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null))) . "/gfx/ter.gif");
        // line 3
        $context["acro_media_logo_url"] = (($this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)) . $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null))) . "/gfx/ter.gif");
        // line 4
        echo "
<footer class=\"site-footer\">
  <div class=\"container\">
    ";
        // line 8
        echo "    <div class=\"site-footer__top\">
      <div class=\"row\">
        <div class=\"col-xs-12 col-sm-6\">
          ";
        // line 12
        echo "          <div class=\"site-footer__logo\">
            <a href=\"";
        // line 13
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["front_page"] ?? null)), "html", null, true);
        echo "\">
              <img src=\"";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["site_logo_icon_url"] ?? null)), "html", null, true);
        echo "\" alt=\"";
        ((($context["site_name"] ?? null)) ? (print ($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["site_name"] ?? null), "html", null, true))) : (print ("")));
        echo "\" />
            </a>
          </div>

          ";
        // line 19
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "footer_top", [])) {
            // line 20
            echo "            <div class=\"site-footer__contact\">
              ";
            // line 21
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_top", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 24
        echo "        </div>

        <div class=\"col-xs-12 col-sm-6\">
          ";
        // line 28
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "social_nav", [])) {
            // line 29
            echo "            <div class=\"social-media-nav\">
              ";
            // line 30
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "social_nav", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 33
        echo "        </div>
      </div>
    </div>

    ";
        // line 38
        echo "    <div class=\"site-footer__main\">
      <div class=\"row\">
        <div class=\"col-xs-12 col-md-3 col-lg-4\">
          ";
        // line 42
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 43
            echo "            <div class=\"\">
              ";
            // line 44
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 47
        echo "        </div>

        <div class=\"hidden-xs hidden-sm col-md-9 col-lg-8\">
          ";
        // line 50
        if ($this->getAttribute(($context["page"] ?? null), "primary_nav", [])) {
            // line 51
            echo "            ";
            // line 52
            echo "            <div class=\"footer-main-nav\">
              ";
            // line 53
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "primary_nav", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 56
        echo "
          ";
        // line 57
        if ($this->getAttribute(($context["page"] ?? null), "special_nav", [])) {
            // line 58
            echo "            ";
            // line 59
            echo "            <div class=\"footer-main-nav\">
              ";
            // line 60
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "special_nav", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 63
        echo "
          ";
        // line 64
        if ($this->getAttribute(($context["page"] ?? null), "header_nav", [])) {
            // line 65
            echo "            ";
            // line 66
            echo "            <div class=\"footer-main-nav\">
              ";
            // line 67
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header_nav", [])), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 70
        echo "        </div>
      </div>
    </div>

    ";
        // line 75
        echo "    <div class=\"site-footer__bottom\">
      
  </div>
</footer>


";
    }

    public function getTemplateName()
    {
        return "/themes/custom/shopZ/templates/pages/includes/site_footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 75,  187 => 70,  181 => 67,  178 => 66,  176 => 65,  174 => 64,  171 => 63,  165 => 60,  162 => 59,  160 => 58,  158 => 57,  155 => 56,  149 => 53,  146 => 52,  144 => 51,  142 => 50,  137 => 47,  131 => 44,  128 => 43,  125 => 42,  120 => 38,  114 => 33,  108 => 30,  105 => 29,  102 => 28,  97 => 24,  91 => 21,  88 => 20,  85 => 19,  76 => 14,  72 => 13,  69 => 12,  64 => 8,  59 => 4,  57 => 3,  55 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{# Set the path for the footer logo icon. #}
{% set site_logo_icon_url =  base_path ~ directory ~ '/gfx/ter.gif' %}
{% set acro_media_logo_url =  base_path ~ directory ~ '/gfx/ter.gif' %}

<footer class=\"site-footer\">
  <div class=\"container\">
    {# Footer top. #}
    <div class=\"site-footer__top\">
      <div class=\"row\">
        <div class=\"col-xs-12 col-sm-6\">
          {# Logo. #}
          <div class=\"site-footer__logo\">
            <a href=\"{{ front_page }}\">
              <img src=\"{{ site_logo_icon_url }}\" alt=\"{{ site_name ? site_name }}\" />
            </a>
          </div>

          {# Contact info. #}
          {% if page.footer_top %}
            <div class=\"site-footer__contact\">
              {{ page.footer_top }}
            </div>
          {% endif %}
        </div>

        <div class=\"col-xs-12 col-sm-6\">
          {# Social media navigation. #}
          {% if page.social_nav %}
            <div class=\"social-media-nav\">
              {{ page.social_nav }}
            </div>
          {% endif %}
        </div>
      </div>
    </div>

    {# Footer main. #}
    <div class=\"site-footer__main\">
      <div class=\"row\">
        <div class=\"col-xs-12 col-md-3 col-lg-4\">
          {# Store address. #}
          {% if page.footer %}
            <div class=\"\">
              {{ page.footer }}
            </div>
          {% endif %}
        </div>

        <div class=\"hidden-xs hidden-sm col-md-9 col-lg-8\">
          {% if page.primary_nav %}
            {# Primary navigation in footer. #}
            <div class=\"footer-main-nav\">
              {{ page.primary_nav }}
            </div>
          {% endif %}

          {% if page.special_nav %}
            {# Special navigation in footer. #}
            <div class=\"footer-main-nav\">
              {{ page.special_nav }}
            </div>
          {% endif %}

          {% if page.header_nav %}
            {# Header navigation in footer. #}
            <div class=\"footer-main-nav\">
              {{ page.header_nav }}
            </div>
          {% endif %}
        </div>
      </div>
    </div>

    {# Footer bottom. #}
    <div class=\"site-footer__bottom\">
      
  </div>
</footer>


", "/themes/custom/shopZ/templates/pages/includes/site_footer.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/pages/includes/site_footer.html.twig");
    }
}
