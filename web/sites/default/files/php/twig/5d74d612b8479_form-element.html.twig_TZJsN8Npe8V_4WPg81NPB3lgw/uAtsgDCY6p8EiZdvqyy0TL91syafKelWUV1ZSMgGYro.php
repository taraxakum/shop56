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

/* themes/custom/shopZ/templates/input/form-element.html.twig */
class __TwigTemplate_2fd459804ed9865c01e8fd7b980d04e329c1ac20c769a1697c981f123236917f extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 49, "if" => 73];
        $filters = ["clean_class" => 52, "escape" => 74];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape'],
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
        // line 49
        $context["classes"] = [0 => "form-item", 1 => "js-form-item", 2 => ("form-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 52
($context["type"] ?? null)))), 3 => ("js-form-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 53
($context["type"] ?? null)))), 4 => ("form-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 54
($context["name"] ?? null)))), 5 => ("js-form-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 55
($context["name"] ?? null)))), 6 => ((!twig_in_filter(        // line 56
($context["title_display"] ?? null), [0 => "after", 1 => "before"])) ? ("form-no-label") : ("")), 7 => (((        // line 57
($context["disabled"] ?? null) == "disabled")) ? ("form-disabled") : ("")), 8 => ((        // line 58
($context["is_form_group"] ?? null)) ? ("form-group") : ("")), 9 => ((        // line 59
($context["is_radio"] ?? null)) ? ("radio") : ("")), 10 => ((        // line 60
($context["is_checkbox"] ?? null)) ? ("checkbox") : ("")), 11 => ((        // line 61
($context["is_autocomplete"] ?? null)) ? ("form-autocomplete") : ("")), 12 => ((        // line 62
($context["errors"] ?? null)) ? ("error has-error") : (""))];
        // line 65
        $context["description_classes"] = [0 => "description", 1 => "help-block", 2 => (((        // line 68
($context["description_display"] ?? null) == "invisible")) ? ("visually-hidden") : (""))];
        // line 71
        echo "
";
        // line 73
        if ((\Drupal\Component\Utility\Html::getClass(($context["name"] ?? null)) != "field-review-rating")) {
            // line 74
            echo "<div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
            echo ">
  ";
        }
        // line 76
        echo "
  ";
        // line 77
        if (twig_in_filter(($context["label_display"] ?? null), [0 => "before", 1 => "invisible"])) {
            // line 78
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 80
        echo "
  ";
        // line 81
        if ( !twig_test_empty(($context["prefix"] ?? null))) {
            // line 82
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 84
        echo "
  ";
        // line 85
        if (((($context["description_display"] ?? null) == "before") && $this->getAttribute(($context["description"] ?? null), "content", []))) {
            // line 86
            echo "    <div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "attributes", [])), "html", null, true);
            echo ">
      ";
            // line 87
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "content", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 90
        echo "
  ";
        // line 91
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null)), "html", null, true);
        echo "

  ";
        // line 93
        if ( !twig_test_empty(($context["suffix"] ?? null))) {
            // line 94
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 96
        echo "
  ";
        // line 97
        if ((($context["label_display"] ?? null) == "after")) {
            // line 98
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 100
        echo "
  ";
        // line 101
        if ((twig_in_filter(($context["description_display"] ?? null), [0 => "after", 1 => "invisible"]) && $this->getAttribute(($context["description"] ?? null), "content", []))) {
            // line 102
            echo "    <div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["description"] ?? null), "attributes", []), "addClass", [0 => ($context["description_classes"] ?? null)], "method")), "html", null, true);
            echo ">
      ";
            // line 103
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "content", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 106
        echo "
  ";
        // line 107
        if ((\Drupal\Component\Utility\Html::getClass(($context["name"] ?? null)) != "field-review-rating")) {
            // line 108
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/custom/shopZ/templates/input/form-element.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 108,  166 => 107,  163 => 106,  157 => 103,  152 => 102,  150 => 101,  147 => 100,  141 => 98,  139 => 97,  136 => 96,  130 => 94,  128 => 93,  123 => 91,  120 => 90,  114 => 87,  109 => 86,  107 => 85,  104 => 84,  98 => 82,  96 => 81,  93 => 80,  87 => 78,  85 => 77,  82 => 76,  76 => 74,  74 => 73,  71 => 71,  69 => 68,  68 => 65,  66 => 62,  65 => 61,  64 => 60,  63 => 59,  62 => 58,  61 => 57,  60 => 56,  59 => 55,  58 => 54,  57 => 53,  56 => 52,  55 => 49,);
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
 * Default theme implementation for a form element.
 *
 * Available variables:
 * - attributes: HTML attributes for the containing element.
 * - prefix: (optional) The form element prefix, may not be set.
 * - suffix: (optional) The form element suffix, may not be set.
 * - required: The required marker, or empty if the associated form element is
 *   not required.
 * - type: The type of the element.
 * - name: The name of the element.
 * - label: A rendered label element.
 * - label_display: Label display setting. It can have these values:
 *   - before: The label is output before the element. This is the default.
 *     The label includes the #title and the required marker, if #required.
 *   - after: The label is output after the element. For example, this is used
 *     for radio and checkbox #type elements. If the #title is empty but the
 *     field is #required, the label will contain only the required marker.
 *   - invisible: Labels are critical for screen readers to enable them to
 *     properly navigate through forms but can be visually distracting. This
 *     property hides the label for everyone except screen readers.
 *   - attribute: Set the title attribute on the element to create a tooltip but
 *     output no label element. This is supported only for checkboxes and radios
 *     in \\Drupal\\Core\\Render\\Element\\CompositeFormElementTrait::preRenderCompositeFormElement().
 *     It is used where a visual label is not needed, such as a table of
 *     checkboxes where the row and column provide the context. The tooltip will
 *     include the title and required marker.
 * - description: (optional) A list of description properties containing:
 *    - content: A description of the form element, may not be set.
 *    - attributes: (optional) A list of HTML attributes to apply to the
 *      description content wrapper. Will only be set when description is set.
 * - description_display: Description display setting. It can have these values:
 *   - before: The description is output before the element.
 *   - after: The description is output after the element. This is the default
 *     value.
 *   - invisible: The description is output after the element, hidden visually
 *     but available to screen readers.
 * - disabled: True if the element is disabled.
 * - title_display: Title display setting.
 *
 * @see template_preprocess_form_element()
 *
 * @ingroup templates
 */
#}
{%
  set classes = [
    'form-item',
    'js-form-item',
    'form-type-' ~ type|clean_class,
    'js-form-type-' ~ type|clean_class,
    'form-item-' ~ name|clean_class,
    'js-form-item-' ~ name|clean_class,
    title_display not in ['after', 'before'] ? 'form-no-label',
    disabled == 'disabled' ? 'form-disabled',
    is_form_group ? 'form-group',
    is_radio ? 'radio',
    is_checkbox ? 'checkbox',
    is_autocomplete ? 'form-autocomplete',
    errors ? 'error has-error'
  ]
%}{%
  set description_classes = [
    'description',
    'help-block',
    description_display == 'invisible' ? 'visually-hidden',
  ]
%}

{# Check to see if it's review rating, and if so, don't place this div #}
{% if name|clean_class != 'field-review-rating' %}
<div{{ attributes.addClass(classes) }}>
  {% endif %}

  {% if label_display in ['before', 'invisible'] %}
    {{ label }}
  {% endif %}

  {% if prefix is not empty %}
    {{ prefix }}
  {% endif %}

  {% if description_display == 'before' and description.content %}
    <div{{ description.attributes }}>
      {{ description.content }}
    </div>
  {% endif %}

  {{ children }}

  {% if suffix is not empty %}
    {{ suffix }}
  {% endif %}

  {% if label_display == 'after' %}
    {{ label }}
  {% endif %}

  {% if description_display in ['after', 'invisible'] and description.content %}
    <div{{ description.attributes.addClass(description_classes) }}>
      {{ description.content }}
    </div>
  {% endif %}

  {% if name|clean_class != 'field-review-rating' %}
</div>
{% endif %}
", "themes/custom/shopZ/templates/input/form-element.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/input/form-element.html.twig");
    }
}
