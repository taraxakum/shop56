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

/* themes/custom/shopZ/templates/menus/menu--menyu-gl.html.twig */
class __TwigTemplate_6a6a9e0a0947b47fd11f45885efe52cbe17c707aee79b64c56c24794194cfc90 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 23, "macro" => 31, "set" => 34, "if" => 48, "for" => 54];
        $filters = ["clean_class" => 37, "escape" => 50];
        $functions = ["link" => 70];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'set', 'if', 'for'],
                ['clean_class', 'escape'],
                ['link']
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
        // line 23
        $context["menus"] = $this;
        // line 24
        echo "
";
        // line 29
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links_g(($context["items"] ?? null), ($context["attributes"] ?? null), 0, ($context["menu_name"] ?? null)));
        echo "

";
    }

    // line 31
    public function getmenu_links_g($__items__ = null, $__attributes__ = null, $__menu_level__ = null, $__menu_name__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "menu_name" => $__menu_name__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 32
            echo "  ";
            $context["menus"] = $this;
            // line 33
            echo "  ";
            // line 34
            $context["menu_classes"] = [0 => "menu", 1 => "menu--parent", 2 => ("menu--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(            // line 37
($context["menu_name"] ?? null)))), 3 => ("menu--level-" . $this->sandbox->ensureToStringAllowed(            // line 38
($context["menu_level"] ?? null)))];
            // line 41
            echo "  ";
            // line 42
            $context["sub_menu_classes"] = [0 => "menu", 1 => "menu--child", 2 => ("menu--level-" . $this->sandbox->ensureToStringAllowed(            // line 45
($context["menu_level"] ?? null)))];
            // line 48
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 49
                echo "    ";
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 50
                    echo "      <ul";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["menu_classes"] ?? null)], "method")), "html", null, true);
                    echo ">
    ";
                } else {
                    // line 52
                    echo "      <ul";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["attributes"] ?? null), "removeClass", [0 => ($context["menu_classes"] ?? null)], "method"), "addClass", [0 => ($context["sub_menu_classes"] ?? null)], "method"), "removeClass", [0 => ("menu--level-" . (($context["menu_level"] ?? null) - 1))], "method")), "html", null, true);
                    echo ">
    ";
                }
                // line 54
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 55
                    echo "      ";
                    // line 56
                    $context["item_classes"] = [0 => "menu__item", 1 => ("menu__item--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(                    // line 58
$context["item"], "title", [])))), 2 => (($this->getAttribute(                    // line 59
$context["item"], "is_expanded", [])) ? ("menu__item--expanded") : ("")), 3 => (($this->getAttribute(                    // line 60
$context["item"], "in_active_trail", [])) ? ("menu__item--active-trail") : (""))];
                    // line 63
                    echo "      ";
                    // line 64
                    $context["link_classes"] = [0 => "menu__link_g", 1 => (($this->getAttribute(                    // line 66
$context["item"], "in_active_trail", [])) ? ("menu__link_g--active-trail") : (""))];
                    // line 69
                    echo "      <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => ($context["item_classes"] ?? null)], "method")), "html", null, true);
                    echo ">
        ";
                    // line 70
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getLink($this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "removeClass", [0 => ($context["item_classes"] ?? null)], "method"), "addClass", [0 => ($context["link_classes"] ?? null)], "method"))), "html", null, true);
                    echo "
        ";
                    // line 71
                    if ($this->getAttribute($context["item"], "below", [])) {
                        // line 72
                        echo "          ";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links_g($this->getAttribute($context["item"], "below", []), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1)));
                        echo "
        ";
                    }
                    // line 74
                    echo "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 76
                echo "    </ul>
  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "themes/custom/shopZ/templates/menus/menu--menyu-gl.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  155 => 76,  148 => 74,  142 => 72,  140 => 71,  136 => 70,  131 => 69,  129 => 66,  128 => 64,  126 => 63,  124 => 60,  123 => 59,  122 => 58,  121 => 56,  119 => 55,  114 => 54,  108 => 52,  102 => 50,  99 => 49,  96 => 48,  94 => 45,  93 => 42,  91 => 41,  89 => 38,  88 => 37,  87 => 34,  85 => 33,  82 => 32,  67 => 31,  60 => 29,  57 => 24,  55 => 23,);
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
 * Orange Starter theme implementation to display a menu.
 *
 * Available variables:
 * - menu_name: The machine name of the menu.
 * - items: A nested list of menu items. Each menu item contains:
 *   - attributes: HTML attributes for the menu item.
 *   - below: The menu item child items.
 *   - title: The menu link title.
 *   - url: The menu link url, instance of \\Drupal\\Core\\Url
 *   - localized_options: Menu link localized options.
 *   - is_expanded: TRUE if the link has visible children within the current
 *     menu tree.
 *   - is_collapsed: TRUE if the link has children within the current menu tree
 *     that are not currently visible.
 *   - in_active_trail: TRUE if the link is in the active trail.
 *
 * @ingroup themeable
 */
#}
{% import _self as menus %}

{#
  We call a macro which calls itself to render the full tree.
  @see http://twig.sensiolabs.org/doc/tags/macro.html
#}
{{ menus.menu_links_g(items, attributes, 0, menu_name) }}

{% macro menu_links_g(items, attributes, menu_level, menu_name) %}
  {% import _self as menus %}
  {%
    set menu_classes = [
      'menu',
      'menu--parent',
      'menu--' ~ menu_name|clean_class,
      'menu--level-' ~ menu_level,
    ]
  %}
  {%
    set sub_menu_classes = [
      'menu',
      'menu--child',
      'menu--level-' ~ menu_level,
    ]
  %}
  {% if items %}
    {% if menu_level == 0 %}
      <ul{{ attributes.addClass(menu_classes) }}>
    {% else %}
      <ul{{ attributes.removeClass(menu_classes).addClass(sub_menu_classes).removeClass('menu--level-' ~ (menu_level - 1)) }}>
    {% endif %}
    {% for item in items %}
      {%
        set item_classes = [
          'menu__item',
          'menu__item--' ~ item.title|clean_class,
          item.is_expanded ? 'menu__item--expanded',
          item.in_active_trail ? 'menu__item--active-trail',
        ]
      %}
      {%
        set link_classes = [
          'menu__link_g',
          item.in_active_trail ? 'menu__link_g--active-trail',
        ]
      %}
      <li{{ item.attributes.addClass(item_classes) }}>
        {{ link(item.title, item.url, item.attributes.removeClass(item_classes).addClass(link_classes)) }}
        {% if item.below %}
          {{ menus.menu_links_g(item.below, attributes, menu_level + 1) }}
        {% endif %}
      </li>
    {% endfor %}
    </ul>
  {% endif %}
{% endmacro %}
", "themes/custom/shopZ/templates/menus/menu--menyu-gl.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/menus/menu--menyu-gl.html.twig");
    }
}
