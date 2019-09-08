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

/* themes/custom/shopZ/templates/input/form-element-label.html.twig */
class __TwigTemplate_83d1f095dccf7b9067c04c8954f36341fb15b2e41058a5065eddca59a255e56b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 20, "if" => 27];
        $filters = ["escape" => 28, "t" => 36];
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
        // line 20
        $context["classes"] = [0 => "control-label", 1 => (((        // line 22
($context["title_display"] ?? null) == "after")) ? ("option") : ("")), 2 => (((        // line 23
($context["title_display"] ?? null) == "invisible")) ? ("sr-only") : ("")), 3 => ((        // line 24
($context["required"] ?? null)) ? ("js-form-required") : (""))];
        // line 27
        if ( !twig_test_empty(($context["title"] ?? null))) {
            // line 28
            echo "<label";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
            echo ">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["element"] ?? null)), "html", null, true);
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            // line 29
            if (($context["description"] ?? null)) {
                // line 30
                echo "<p class=\"help-block\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null)), "html", null, true);
                echo "</p>";
            }
            // line 32
            echo "</label>";
            // line 33
            if ((($context["required"] ?? null) && ((($context["title_display"] ?? null) == "before") || (($context["title_display"] ?? null) == "after")))) {
                // line 34
                echo "<span class=\"form-required\"> *</span>";
            } else {
                // line 36
                echo "<span class=\"form-optional\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t(" - Optional"));
                echo "</span>";
            }
        }
    }

    public function getTemplateName()
    {
        return "themes/custom/shopZ/templates/input/form-element-label.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 36,  79 => 34,  77 => 33,  75 => 32,  70 => 30,  68 => 29,  62 => 28,  60 => 27,  58 => 24,  57 => 23,  56 => 22,  55 => 20,);
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
 * Default theme implementation for a form element label.
 *
 * Available variables:
 * - element: an input element.
 * - title: The label's text.
 * - title_display: Elements title_display setting.
 * - description: element description.
 * - required: An indicator for whether the associated form element is required.
 * - attributes: A list of HTML attributes for the label.
 *
 * @see template_preprocess_form_element_label()
 *
 * @ingroup templates
 */
#}
{%-
  set classes = [
    'control-label',
    title_display == 'after' ? 'option',
    title_display == 'invisible' ? 'sr-only',
    required ? 'js-form-required',
  ]
-%}
{%- if title is not empty -%}
  <label{{ attributes.addClass(classes) }}>{{ element }}{{ title }}
    {%- if description -%}
      <p class=\"help-block\">{{ description }}</p>
    {%- endif -%}
  </label>
  {%- if required and (title_display == 'before' or title_display == 'after') -%}
    <span class=\"form-required\"> *</span>
  {%- else -%}
    <span class=\"form-optional\">{{ ' - Optional'|t }}</span>
  {%- endif -%}
{%- endif -%}
", "themes/custom/shopZ/templates/input/form-element-label.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/input/form-element-label.html.twig");
    }
}
