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

/* modules/contrib/simple_menu_icons/templates/simple-menu-icons-css-item.html.twig */
class __TwigTemplate_98b52008d5ea30a68babcaa2e716f58b58613c87362471b5f2b47e599e0ada13 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 11];
        $filters = ["escape" => 12];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for'],
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
        // line 10
        echo "
";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["icons"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["icon"]) {
            // line 12
            echo "    a.menu-icon-";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["icon"], "mlid", [])), "html", null, true);
            echo ",
    ul.links li.menu-icon-";
            // line 13
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["icon"], "mlid", [])), "html", null, true);
            echo " a,
    ul.menu li.menu-icon-";
            // line 14
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["icon"], "mlid", [])), "html", null, true);
            echo " a {
        background-image: url(";
            // line 15
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["icon"], "path", [])), "html", null, true);
            echo ");
        padding-left:";
            // line 16
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["icon"], "width", [])), "html", null, true);
            echo "px;
        background-repeat: no-repeat;
        background-position: left center;
    }
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['icon'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "modules/contrib/simple_menu_icons/templates/simple-menu-icons-css-item.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 16,  75 => 15,  71 => 14,  67 => 13,  62 => 12,  58 => 11,  55 => 10,);
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
 *
 * Template file for generating the CSS file used for the menu item icons.
 */

#}

{% for icon in icons %}
    a.menu-icon-{{ icon.mlid }},
    ul.links li.menu-icon-{{ icon.mlid }} a,
    ul.menu li.menu-icon-{{ icon.mlid }} a {
        background-image: url({{ icon.path }});
        padding-left:{{ icon.width }}px;
        background-repeat: no-repeat;
        background-position: left center;
    }
{% endfor %}
", "modules/contrib/simple_menu_icons/templates/simple-menu-icons-css-item.html.twig", "/h/shopsakataby/htdocs/web/modules/contrib/simple_menu_icons/templates/simple-menu-icons-css-item.html.twig");
    }
}
