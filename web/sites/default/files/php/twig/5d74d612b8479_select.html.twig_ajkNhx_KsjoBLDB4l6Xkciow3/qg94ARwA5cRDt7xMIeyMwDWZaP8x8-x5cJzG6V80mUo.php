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

/* themes/custom/shopZ/templates/input/select.html.twig */
class __TwigTemplate_b9fbe587550c872e681d040f8713112560ae09636631096ccda4c76b8bf67e4a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["spaceless" => 16, "if" => 17, "set" => 30, "for" => 32];
        $filters = ["escape" => 22];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['spaceless', 'if', 'set', 'for'],
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
        // line 16
        ob_start();
        // line 17
        echo "  ";
        if (($context["input_group"] ?? null)) {
            // line 18
            echo "    <div class=\"input-group\">
  ";
        }
        // line 20
        echo "
  ";
        // line 21
        if (($context["prefix"] ?? null)) {
            // line 22
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 24
        echo "
  ";
        // line 29
        echo "  <div class=\"select-wrapper\">
    ";
        // line 30
        $context["classes"] = [0 => "form-control"];
        // line 31
        echo "    <select";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
      ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 33
            echo "        ";
            if (($this->getAttribute($context["option"], "type", []) == "optgroup")) {
                // line 34
                echo "          <optgroup label=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["option"], "label", [])), "html", null, true);
                echo "\">
            ";
                // line 35
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["option"], "options", []));
                foreach ($context['_seq'] as $context["_key"] => $context["sub_option"]) {
                    // line 36
                    echo "              <option
                value=\"";
                    // line 37
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["sub_option"], "value", [])), "html", null, true);
                    echo "\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute($context["sub_option"], "selected", [])) ? (" selected=\"selected\"") : ("")));
                    echo ">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["sub_option"], "label", [])), "html", null, true);
                    echo "</option>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sub_option'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 39
                echo "          </optgroup>
        ";
            } elseif (($this->getAttribute(            // line 40
$context["option"], "type", []) == "option")) {
                // line 41
                echo "          <option
            value=\"";
                // line 42
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["option"], "value", [])), "html", null, true);
                echo "\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute($context["option"], "selected", [])) ? (" selected=\"selected\"") : ("")));
                echo ">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["option"], "label", [])), "html", null, true);
                echo "</option>
        ";
            }
            // line 44
            echo "      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "    </select>
  </div>

  ";
        // line 48
        if (($context["suffix"] ?? null)) {
            // line 49
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 51
        echo "
  ";
        // line 52
        if (($context["input_group"] ?? null)) {
            // line 53
            echo "    </div>
  ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "themes/custom/shopZ/templates/input/select.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 53,  158 => 52,  155 => 51,  149 => 49,  147 => 48,  142 => 45,  136 => 44,  127 => 42,  124 => 41,  122 => 40,  119 => 39,  107 => 37,  104 => 36,  100 => 35,  95 => 34,  92 => 33,  88 => 32,  83 => 31,  81 => 30,  78 => 29,  75 => 24,  69 => 22,  67 => 21,  64 => 20,  60 => 18,  57 => 17,  55 => 16,);
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
 * Theme override for a select element.
 *
 * Available variables:
 * - attributes: HTML attributes for the select tag.
 * - input_group: Flag to display as an input group.
 * - options: The option element children.
 * - prefix: Markup to display before the input element.
 * - suffix: Markup to display after the input element.
 *
 * @see template_preprocess_select()
 */
#}
{% spaceless %}
  {% if input_group %}
    <div class=\"input-group\">
  {% endif %}

  {% if prefix %}
    {{ prefix }}
  {% endif %}

  {# Browsers do not recognize pseudo :after selectors, we must create a wrapper
   # around the select element to style it properly.
   # @see http://stackoverflow.com/q/21103542
   #}
  <div class=\"select-wrapper\">
    {% set classes = ['form-control'] %}
    <select{{ attributes.addClass(classes) }}>
      {% for option in options %}
        {% if option.type == 'optgroup' %}
          <optgroup label=\"{{ option.label }}\">
            {% for sub_option in option.options %}
              <option
                value=\"{{ sub_option.value }}\"{{ sub_option.selected ? ' selected=\"selected\"' }}>{{ sub_option.label }}</option>
            {% endfor %}
          </optgroup>
        {% elseif option.type == 'option' %}
          <option
            value=\"{{ option.value }}\"{{ option.selected ? ' selected=\"selected\"' }}>{{ option.label }}</option>
        {% endif %}
      {% endfor %}
    </select>
  </div>

  {% if suffix %}
    {{ suffix }}
  {% endif %}

  {% if input_group %}
    </div>
  {% endif %}
{% endspaceless %}
", "themes/custom/shopZ/templates/input/select.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/input/select.html.twig");
    }
}
