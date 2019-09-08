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

/* themes/custom/shopZ/templates/pages/page.html.twig */
class __TwigTemplate_0a72e6b2ed6b44e93bbd9a95887e203988e33b0153854888380c59e1ff7c36bf extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 48, "include" => 57, "if" => 64];
        $filters = ["render" => 48, "trim" => 49, "striptags" => 49, "escape" => 63, "without" => 82];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'include', 'if'],
                ['render', 'trim', 'striptags', 'escape', 'without'],
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
        // line 48
        $context["page_sidebar_rendered"] = $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "page_sidebar", [])));
        // line 49
        $context["page_sidebar_exists"] = ((twig_trim_filter(strip_tags($this->sandbox->ensureToStringAllowed(($context["page_sidebar_rendered"] ?? null)), "<a><img>"))) ? (true) : (false));
        // line 50
        echo "
";
        // line 52
        $context["row_class"] = ((($context["page_sidebar_exists"] ?? null)) ? ("row-sidebar row-eq-height") : (""));
        // line 53
        $context["col_class"] = ((($context["page_sidebar_exists"] ?? null)) ? ("col-sm-8 col-md-9") : ("col-sm-12"));
        // line 54
        $context["content_class"] = ((($context["page_sidebar_exists"] ?? null)) ? ("content__main-content--with-sidebar") : (""));
        // line 55
        echo "
";
        // line 57
        $this->loadTemplate(((($context["base_path"] ?? null) . ($context["directory"] ?? null)) . "/templates/pages/includes/site_header.html.twig"), "themes/custom/shopZ/templates/pages/page.html.twig", 57)->display($context);
        // line 59
        echo "
";
        // line 61
        echo "<div class=\"site-content\">
  <div class=\"container\">
    <div class=\"row ";
        // line 63
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["row_class"] ?? null)), "html", null, true);
        echo "\">
      ";
        // line 64
        if (($context["page_sidebar_exists"] ?? null)) {
            // line 65
            echo "        <div class=\"col-sm-4 col-md-3 hidden-xs\">
          <aside class=\"site-sidebar\" role=\"complementary\">
            ";
            // line 67
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "page_sidebar", [])), "html", null, true);
            echo "
          </aside>
        </div>
      ";
        }
        // line 71
        echo "
      <div class=\"";
        // line 72
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["col_class"] ?? null)), "html", null, true);
        echo "\">
        <main class=\"content__main-content ";
        // line 73
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content_class"] ?? null)), "html", null, true);
        echo " clearfix\" role=\"main\">
          <div class=\"visually-hidden\"><a id=\"main-content\" tabindex=\"-1\"></a></div>
          ";
        // line 75
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 76
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
            echo "
          ";
        }
        // line 78
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "above_content", [])) {
            // line 79
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "above_content", [])), "html", null, true);
            echo "
          ";
        }
        // line 81
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "content", [])) {
            // line 82
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "field_paragraphs_reference_2"), "html", null, true);
            echo "
          ";
        }
        // line 84
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "below_content", [])) {
            // line 85
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "below_content", [])), "html", null, true);
            echo "
          ";
        }
        // line 87
        echo "        </main>
      </div>
    </div>
  </div>

  ";
        // line 93
        echo "  ";
        if ((($context["node"] ?? null) && $this->getAttribute($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_paragraphs_reference_2", []), 0, []), "target_id", []))) {
            // line 94
            echo "    <div class=\"container-fluid\">
      <div class=\"row\">
        <div class=\"col-sm-12 page-footer-components\">
          <main class=\"content__main-content clearfix\" role=\"complementary\">
 
          </main>
        </div>
      </div>
    </div>
  ";
        }
        // line 104
        echo "  ";
        // line 105
        echo "
</div>
";
        // line 108
        echo "
";
        // line 110
        $this->loadTemplate(((($context["base_path"] ?? null) . ($context["directory"] ?? null)) . "/templates/pages/includes/site_footer.html.twig"), "themes/custom/shopZ/templates/pages/page.html.twig", 110)->display($context);
    }

    public function getTemplateName()
    {
        return "themes/custom/shopZ/templates/pages/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 110,  172 => 108,  168 => 105,  166 => 104,  154 => 94,  151 => 93,  144 => 87,  138 => 85,  135 => 84,  129 => 82,  126 => 81,  120 => 79,  117 => 78,  111 => 76,  109 => 75,  104 => 73,  100 => 72,  97 => 71,  90 => 67,  86 => 65,  84 => 64,  80 => 63,  76 => 61,  73 => 59,  71 => 57,  68 => 55,  66 => 54,  64 => 53,  62 => 52,  59 => 50,  57 => 49,  55 => 48,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Theme implementation to display a single Drupal page.
 *
 * The doctype, html, head, and body tags are not in this template. Instead
 * they can be found in the html.html.twig template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 * - logo: The url of the logo image, as defined in theme settings.
 * - site_name: The name of the site. This is empty when displaying the site
 *   name has been disabled in the theme settings.
 * - site_slogan: The slogan of the site. This is empty when displaying the site
 *   slogan has been disabled in theme settings.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.header: Items for the header region.
 * - page.pre_content: Items for the pre-content region.
 * - page.breadcrumb: Items for the breadcrumb region.
 * - page.highlighted: Items for the highlighted region.
 * - page.help: Dynamic help text, mostly for admin pages.
 * - page.content: The main content of the current page.
 *
 * @see template_preprocess_page()
 * @see seven_preprocess_page()
 * @see html.html.twig
 */
#}
{% set page_sidebar_rendered = page.page_sidebar|render %}
{% set page_sidebar_exists = page_sidebar_rendered|striptags('<a><img>')|trim ? true : false %}

{# Set row and column class based on sidebar. #}
{% set row_class = page_sidebar_exists ? 'row-sidebar row-eq-height' %}
{% set col_class = page_sidebar_exists ? 'col-sm-8 col-md-9' : 'col-sm-12' %}
{% set content_class = page_sidebar_exists ? 'content__main-content--with-sidebar' %}

{# Site Header. #}
{% include base_path ~ directory ~ '/templates/pages/includes/site_header.html.twig' %}
{# / Site Header. #}

{# Main Content. #}
<div class=\"site-content\">
  <div class=\"container\">
    <div class=\"row {{ row_class }}\">
      {% if page_sidebar_exists %}
        <div class=\"col-sm-4 col-md-3 hidden-xs\">
          <aside class=\"site-sidebar\" role=\"complementary\">
            {{ page.page_sidebar }}
          </aside>
        </div>
      {% endif %}

      <div class=\"{{ col_class }}\">
        <main class=\"content__main-content {{ content_class }} clearfix\" role=\"main\">
          <div class=\"visually-hidden\"><a id=\"main-content\" tabindex=\"-1\"></a></div>
          {% if page.highlighted %}
            {{ page.highlighted }}
          {% endif %}
          {% if page.above_content %}
            {{ page.above_content }}
          {% endif %}
          {% if page.content %}
            {{ page.content|without('field_paragraphs_reference_2') }}
          {% endif %}
          {% if page.below_content %}
            {{ page.below_content }}
          {% endif %}
        </main>
      </div>
    </div>
  </div>

  {# Footer Components. #}
  {% if node and node.field_paragraphs_reference_2.0.target_id %}
    <div class=\"container-fluid\">
      <div class=\"row\">
        <div class=\"col-sm-12 page-footer-components\">
          <main class=\"content__main-content clearfix\" role=\"complementary\">
 
          </main>
        </div>
      </div>
    </div>
  {% endif %}
  {# / Footer Components. #}

</div>
{# / Main Content. #}

{# Site Footer. #}
{% include base_path ~ directory ~ '/templates/pages/includes/site_footer.html.twig' %}
{# / Site Footer. #}
", "themes/custom/shopZ/templates/pages/page.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/pages/page.html.twig");
    }
}
