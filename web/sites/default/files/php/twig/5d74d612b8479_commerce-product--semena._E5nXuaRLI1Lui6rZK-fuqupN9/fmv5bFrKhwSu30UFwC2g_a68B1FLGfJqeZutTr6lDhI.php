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

/* themes/custom/shopZ/templates/commerce/commerce-product--semena.html.twig */
class __TwigTemplate_fa9bd0e2732cad09ebd4f684902d3b26a7d3d672cbd81a4a53ebf13cd32d91ab extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 22, "set" => 25, "for" => 113];
        $filters = ["clean_class" => 28, "escape" => 33, "t" => 36, "trim" => 41, "render" => 41, "field_value" => 47, "safe_join" => 91, "length" => 103, "field_label" => 201];
        $functions = ["attach_library" => 100, "file_url" => 126, "drupal_entity" => 186];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['clean_class', 'escape', 't', 'trim', 'render', 'field_value', 'safe_join', 'length', 'field_label'],
                ['attach_library', 'file_url', 'drupal_entity']
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
        // line 22
        if ((($context["view_mode"] ?? null) == "teaser")) {
            // line 23
            echo "
  ";
            // line 25
            $context["classesTeaser"] = [0 => "product", 1 => "product--teaser", 2 => ("product--teaser--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(            // line 28
($context["product_entity"] ?? null), "title", []), "value", []))))];
            // line 31
            echo "
  ";
            // line 33
            echo "  <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["product_url"] ?? null)), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classesTeaser"] ?? null)], "method")), "html", null, true);
            echo " aria-label=\"product_entity.title.value\">
    ";
            // line 34
            if ($this->getAttribute($this->getAttribute(($context["product"] ?? null), "field_add_on_products", []), "#items", [], "array")) {
                // line 35
                echo "      <div class=\"add-on-item__teaser-flag\">
        ";
                // line 36
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Bundle<br>Available!"));
                echo "
      </div>
    ";
            }
            // line 39
            echo "
    <div class=\"product__thumbnail\">
      ";
            // line 41
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["product"] ?? null), "field_catalog_image", []))))) {
                // line 42
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_catalog_image", [])), "html", null, true);
                echo "
      ";
            } else {
                // line 44
                echo "        <img src=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)) . $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null))), "html", null, true);
                echo "/gfx/i1.jpg\" class=\"no-product-thumbnail\" alt=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["product_entity"] ?? null), "title", []), "value", [])), "html", null, true);
                echo "\" />
      ";
            }
            // line 45
            echo "\t
\t  
";
            // line 47
            if (twig_in_filter("True", $this->getAttribute($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "variation_field_sk", [])), 0, [], "array"))) {
                // line 48
                echo "<div class=\"sk\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("skidka"));
                echo "</div>
";
            }
            // line 50
            echo "
";
            // line 51
            if (twig_in_filter("True", $this->getAttribute($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "variation_field_nov", [])), 0, [], "array"))) {
                // line 52
                echo "<div class=\"sk2\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("nowinka"));
                echo "</div>
";
            }
            // line 54
            echo "
";
            // line 55
            if (twig_in_filter("True", $this->getAttribute($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "variation_field_rek", [])), 0, [], "array"))) {
                // line 56
                echo "<div class=\"sk1\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("rekomend"));
                echo "</div>
";
            }
            // line 58
            echo "
    </div>
\t";
            // line 60
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "variation_field_upak", [])))) {
                // line 61
                echo "<div class=\"ves_ed\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_field_upak", []))), "html", null, true);
                echo "</div>
 ";
            } else {
                // line 62
                echo "<div class=\"ves_ed\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar("Под заказ");
                echo "</div>
";
            }
            // line 64
            echo "    ";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["product"] ?? null), "variation_field_original_price", []), 0, [], "array"), "#markup", [], "array")) {
                // line 65
                echo "      ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_field_original_price", []))), "html", null, true);
                echo "
    ";
            }
            // line 67
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_list_price", [])), "html", null, true);
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_field_skd", []))), "html", null, true);
            echo "
    ";
            // line 68
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_price", [])), "html", null, true);
            echo "
    ";
            // line 69
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "title", [])), "html", null, true);
            echo "
 
</a>
";
        } else {
            // line 73
            echo "
  ";
            // line 75
            $context["classesFull"] = [0 => "product", 1 => "product--full", 2 => ("product--full--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(            // line 78
($context["product_entity"] ?? null), "title", []), "value", []))))];
            // line 81
            echo "
  ";
            // line 82
            echo "        ";
            // line 83
            echo "        <div class=\"sharethis-inline-share-buttons\"></div>
  <article";
            // line 84
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classesFull"] ?? null)], "method")), "html", null, true);
            echo ">
    <div class=\"row\">
      <div class=\"col-xs-12 back-and-share\">
        ";
            // line 87
            echo "\t
        <a href=\"/products\" class=\"back-to-products\">";
            // line 88
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Back to Products"));
            echo "</a>

";
            // line 90
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_osb_sem", [])))) {
                // line 91
                echo "<div class=\"oso\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_osb_sem", []))), "|"));
                echo "</div> 
";
            }
            // line 93
            echo "
      </div>\t\t
    </div>

    <div class=\"row\">
      ";
            // line 98
            if (($context["product_variation_images"] ?? null)) {
                // line 99
                echo "        ";
                // line 100
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("magnific_popup/magnific_popup"), "html", null, true);
                echo "

        ";
                // line 103
                echo "        ";
                if (((twig_length_filter($this->env, ($context["product_variation_images"] ?? null)) <= 1) || ($this->getAttribute(($context["product_entity"] ?? null), "bundle", []) == "mason_jar"))) {
                    // line 104
                    echo "          ";
                    $context["product_slider_class"] = "product-slider product-slider--no-thumbnails";
                    // line 105
                    echo "        ";
                } else {
                    // line 106
                    echo "          ";
                    $context["product_slider_class"] = "product-slider";
                    // line 107
                    echo "        ";
                }
                // line 108
                echo "
        <div class=\"col-sm-12 col-md-6\">
          ";
                // line 111
                echo "          <div class=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["product_slider_class"] ?? null)), "html", null, true);
                echo "\">
            <div class=\"product-slider__main-slider\">
              ";
                // line 113
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["product_variation_images"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["product_variation"]) {
                    // line 114
                    echo "                ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["product_variation"], "images", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["product_variation_image"]) {
                        // line 115
                        echo "                  ";
                        // line 116
                        echo "                  ";
                        // line 117
                        $context["product_slider_image_thumbnail"] = ["#theme" => "image_style", "#style_name" => "product_large", "#uri" => $this->getAttribute($this->getAttribute($this->getAttribute(                        // line 120
$context["product_variation_image"], "entity", []), "uri", []), "value", []), "#alt" => $this->getAttribute(                        // line 121
$context["product_variation_image"], "alt", [])];
                        // line 124
                        echo "                  <div>
                    <div class=\"product-slider__main-slider__item\">
                      <a href=\"";
                        // line 126
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["product_variation_image"], "entity", []), "uri", []), "value", []))]), "html", null, true);
                        echo "\" class=\"magnific-popup-gallery\">
                        <span>";
                        // line 127
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["product_slider_image_thumbnail"] ?? null)), "html", null, true);
                        echo "</span>
                      </a>
                    </div>
                  </div>
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_variation_image'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 132
                    echo "              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_variation'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 133
                echo "            </div>

            ";
                // line 136
                echo "            <div class=\"product-slider__nav-slider\">
              ";
                // line 137
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["product_variation_images"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["product_variation"]) {
                    // line 138
                    echo "                ";
                    if ($this->getAttribute($context["product_variation"], "variation_id", [])) {
                        // line 139
                        echo "                  ";
                        $context["product_variation_id"] = $this->getAttribute($context["product_variation"], "variation_id", []);
                        // line 140
                        echo "                ";
                    } else {
                        // line 141
                        echo "                  ";
                        $context["product_variation_id"] = "";
                        // line 142
                        echo "                ";
                    }
                    // line 143
                    echo "
                ";
                    // line 144
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["product_variation"], "images", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["product_variation_image"]) {
                        // line 145
                        echo "                  ";
                        // line 146
                        echo "                  ";
                        // line 147
                        $context["product_slider_image_thumbnail"] = ["#theme" => "image_style", "#style_name" => "product_thumb", "#uri" => $this->getAttribute($this->getAttribute($this->getAttribute(                        // line 150
$context["product_variation_image"], "entity", []), "uri", []), "value", []), "#alt" => $this->getAttribute(                        // line 151
$context["product_variation_image"], "alt", [])];
                        // line 154
                        echo "                  <div>
                    <a class=\"product-slider__nav-slider__item\" data-product-variation-id=\"";
                        // line 155
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["product_variation_id"] ?? null)), "html", null, true);
                        echo "\">
                      <span>";
                        // line 156
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["product_slider_image_thumbnail"] ?? null)), "html", null, true);
                        echo "</span>
                    </a>
                  </div>
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_variation_image'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 160
                    echo "              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_variation'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 161
                echo "            </div>
          </div>
        </div>
        ";
                // line 165
                echo "        <div class=\"col-sm-12 col-md-6\">
          <div class=\"product__intro\">
      ";
            } else {
                // line 168
                echo "        ";
                // line 169
                echo "        <div class=\"col-sm-12\">
          <div class=\"product__intro product__intro--full-width\">
      ";
            }
            // line 172
            echo "
<div class=\"block1\">";
            // line 173
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_brand", [])), "html", null, true);
            echo "
            <h1 class=\"page-title\">";
            // line 174
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["product_entity"] ?? null), "title", []), "value", [])), "html", null, true);
            echo "</h1>
            ";
            // line 175
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_short_description", []))), "html", null, true);
            echo "</div> 
<div class=\"block2\">
  <div class=\"blockx1\">";
            // line 177
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_list_price", [])), "html", null, true);
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_price", [])), "html", null, true);
            echo "\t
\t\t    
";
            // line 179
            if ((null === $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "variation_price", [])))) {
                // line 180
                echo "
  ";
            } else {
                // line 182
                echo " <div class=\"est\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_field_est", []))), "html", null, true);
                echo "</div>
";
            }
            // line 184
            echo "
";
            // line 185
            if ((null === $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "variation_price", [])))) {
                // line 186
                echo " ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalEntity("block", "semyannet"), "html", null, true);
                echo "
  ";
            } else {
                // line 188
                echo "  ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variations", [])), "html", null, true);
                echo "
";
            }
            // line 190
            echo "
\t\t

\t\t</div>
  <div class=\"blockx2\">

  
\t";
            // line 197
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_f1", [])))) {
                // line 198
                echo "<div class=\"oni_x\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_f1", []))), "html", null, true);
                echo "</div> 
";
            }
            // line 199
            echo " 
\t";
            // line 200
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_seriya", [])))) {
                // line 201
                echo "<div class=\"oni_x2\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldLabel($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_seriya", []))), "html", null, true);
                echo ":  ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_seriya", []))), "html", null, true);
                echo "</div>
";
            }
            // line 202
            echo "  \t

      \t";
            // line 204
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_str_s", [])))) {
                // line 205
                echo "<div class=\"oni_x2\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldLabel($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_str_s", []))), "html", null, true);
                echo ": ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_str_s", []))), "html", null, true);
                echo "</div>
";
            }
            // line 207
            echo "\t";
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_pro_l", [])))) {
                // line 208
                echo "<div class=\"oni_x2\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldLabel($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_pro_l", []))), "html", null, true);
                echo ":  ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_pro_l", []))), "html", null, true);
                echo "</div> 
";
            }
            // line 210
            echo "


\t";
            // line 213
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_f_pl", [])))) {
                // line 214
                echo "<div class=\"oni_x\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_f_pl", []))), "html", null, true);
                echo " </div>
";
            }
            // line 216
            echo "\t";
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_cv_pl", [])))) {
                // line 217
                echo "<div class=\"oni_x\"> ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_cv_pl", []))), "html", null, true);
                echo " </div>
";
            }
            // line 218
            echo "\t
\t

\t";
            // line 221
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_osb_sem", [])))) {
                // line 222
                echo "<div class=\"oni_x\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_osb_sem", []))), ", "));
                echo "</div> 
";
            }
            // line 224
            echo "
\t";
            // line 225
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "variation_field_gar", [])))) {
                // line 226
                echo "<div class=\"oni_x2\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldLabel($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_field_gar", []))), "html", null, true);
                echo ": ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_field_gar", []))), "html", null, true);
                echo "</div>
";
            }
            // line 228
            echo "
\t";
            // line 229
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_hr", [])))) {
                // line 230
                echo "<div class=\"oni_x\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldLabel($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_hr", []))), "html", null, true);
                echo ": ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_hr", []))), "|"));
                echo "</div> 
";
            }
            // line 232
            echo "\t";
            if ( !twig_test_empty($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->getAttribute(($context["product"] ?? null), "field_ir", [])))) {
                // line 233
                echo "<div class=\"oni_x\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldLabel($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_ir", []))), "html", null, true);
                echo ": ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_ir", []))), "|"));
                echo "</div> 
";
            }
            // line 235
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_sv_ter", []))), "|"));
            echo "
</div>
</div>
<div class=\"block3\">";
            // line 238
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_sroki", [])), "html", null, true);
            echo "</div> 

</div>
</div> 

    <div class=\"row\">
      <div class=\"col-sm-12\">


<script src=\"//code.jquery.com/jquery-1.11.1.min.js\"></script>
<!------ Include the above in your HEAD tag ---------->

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"panel-group\" id=\"accordion\">
                
\t\t\t\t\t\t\t";
            // line 255
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["product"] ?? null), "body", []))))) {
                // line 256
                echo "\t\t\t\t<div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\"><span class=\"glyphicon glyphicon-file\">
                            </span> ";
                // line 260
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Description"));
                echo "</a>
                        </h4>
                    </div>
                    <div id=\"collapseOne\" class=\"panel-collapse collapse in\">
                       <div class=\"active\"> ";
                // line 264
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "body", [])), "html", null, true);
                echo "</div>
                    </div>
                </div>
\t\t\t\t ";
            }
            // line 268
            echo "\t\t\t\t
\t\t\t\t            ";
            // line 269
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["product"] ?? null), "field_specifications", []))))) {
                // line 270
                echo "                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse0\"><span class=\"glyphicon glyphicon-th-list\">
                            </span>  ";
                // line 274
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Specifications"));
                echo "</a>
                        </h4>
                    </div>
                    <div id=\"collapse0\" class=\"panel-collapse collapse\">
                        <div class=\"active\">  ";
                // line 278
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_specifications", [])), "html", null, true);
                echo "
                    </div>
                </div>
                          ";
            }
            // line 282
            echo "\t\t\t\t
\t\t\t\t
\t\t\t\t
\t\t\t\t";
            // line 285
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["product"] ?? null), "field_vi_o1", []))))) {
                // line 286
                echo "                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\"><span class=\"glyphicon glyphicon-facetime-video\">
                            </span> ";
                // line 290
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Video"));
                echo "</a>
                        </h4>
                    </div>
                    <div id=\"collapseTwo\" class=\"panel-collapse collapse\">
                     <div class=\"active\">    ";
                // line 294
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_vi_o", [])), "html", null, true);
                echo "
                    </div>
                </div>
\t\t\t\t";
            }
            // line 298
            echo "\t\t\t\t
\t\t\t\t
\t\t\t\t<div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse3\"><span class=\"glyphicon glyphicon-th-list\">
                            </span>";
            // line 304
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Other things"));
            echo "</a>
                        </h4>
                    </div>
                    <div id=\"collapse3\" class=\"panel-collapse collapse in\">
                      <div class=\"block2\"><div class=\"blockx3\">";
            // line 308
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalEntity("block", "views_media_block_2"), "html", null, true);
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalEntity("block", "views_media_block_4"), "html", null, true);
            echo "
\t\t\t\t\t  ";
            // line 309
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalEntity("block", "views_stati_v_to_block_1"), "html", null, true);
            echo "</div>
\t\t\t\t\t  <div class=\"blockx2\">";
            // line 310
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_vi_o", [])), "html", null, true);
            echo "</div>
                    </div>
                </div>
\t\t\t\t
\t\t\t\t
\t\t\t\t
\t\t\t\t<div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse4\"><span class=\"glyphicon glyphicon-heart\">
                            </span>   ";
            // line 320
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Reviews"));
            echo " <span class=\"badge\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["product_reviews_count"] ?? null)), "html", null, true);
            echo "</span></a>
                        </h4>
                    </div>
                    <div id=\"collapse4\" class=\"panel-collapse collapse in\">
\t\t\t<div class=\"block2\">\t\t
             <div class=\"active\"> 
              <input type=\"checkbox\" id=\"submit-review\">
              <label class=\"btn btn-primary btn-sm\" for=\"submit-review\">";
            // line 327
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Submit a Review"));
            echo "</label>
              <div class=\"review-rating\">
                <p>";
            // line 329
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Overall Rating"));
            echo "</p>
                <span class=\"";
            // line 330
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 1)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"half ";
            // line 331
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 1.5)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"";
            // line 332
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 2)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"half ";
            // line 333
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 2.5)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"";
            // line 334
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 3)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"half ";
            // line 335
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 3.5)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"";
            // line 336
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 4)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"half ";
            // line 337
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) >= 4.5)) ? ("filled") : ("")));
            echo "\"></span>
                <span class=\"";
            // line 338
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((($context["rating_average"] ?? null) == 5)) ? ("filled") : ("")));
            echo "\"></span>
              </div>
              ";
            // line 340
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_product_reviews", [])), "html", null, true);
            echo "
            </div>
                    </div>
                </div>
\t\t\t</div>\t
            </div>
        </div>
    </div>
</div>



    ";
            // line 353
            echo "    ";
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["product"] ?? null), "field_recommended_products", []))))) {
                // line 354
                echo "      <div class=\"row\">
        <div class=\"col-sm-12\">
          <div class=\"recommended-products\">
            ";
                // line 357
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_recommended_products", [])), "html", null, true);
                echo "
          </div>
        </div>
      </div>
    ";
            }
            // line 362
            echo "  </article>

";
        }
    }

    public function getTemplateName()
    {
        return "themes/custom/shopZ/templates/commerce/commerce-product--semena.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  788 => 362,  780 => 357,  775 => 354,  772 => 353,  757 => 340,  752 => 338,  748 => 337,  744 => 336,  740 => 335,  736 => 334,  732 => 333,  728 => 332,  724 => 331,  720 => 330,  716 => 329,  711 => 327,  699 => 320,  686 => 310,  682 => 309,  677 => 308,  670 => 304,  662 => 298,  655 => 294,  648 => 290,  642 => 286,  640 => 285,  635 => 282,  628 => 278,  621 => 274,  615 => 270,  613 => 269,  610 => 268,  603 => 264,  596 => 260,  590 => 256,  588 => 255,  568 => 238,  562 => 235,  554 => 233,  551 => 232,  543 => 230,  541 => 229,  538 => 228,  530 => 226,  528 => 225,  525 => 224,  519 => 222,  517 => 221,  512 => 218,  506 => 217,  503 => 216,  497 => 214,  495 => 213,  490 => 210,  482 => 208,  479 => 207,  471 => 205,  469 => 204,  465 => 202,  457 => 201,  455 => 200,  452 => 199,  446 => 198,  444 => 197,  435 => 190,  429 => 188,  423 => 186,  421 => 185,  418 => 184,  412 => 182,  408 => 180,  406 => 179,  400 => 177,  395 => 175,  391 => 174,  387 => 173,  384 => 172,  379 => 169,  377 => 168,  372 => 165,  367 => 161,  361 => 160,  351 => 156,  347 => 155,  344 => 154,  342 => 151,  341 => 150,  340 => 147,  338 => 146,  336 => 145,  332 => 144,  329 => 143,  326 => 142,  323 => 141,  320 => 140,  317 => 139,  314 => 138,  310 => 137,  307 => 136,  303 => 133,  297 => 132,  286 => 127,  282 => 126,  278 => 124,  276 => 121,  275 => 120,  274 => 117,  272 => 116,  270 => 115,  265 => 114,  261 => 113,  255 => 111,  251 => 108,  248 => 107,  245 => 106,  242 => 105,  239 => 104,  236 => 103,  230 => 100,  228 => 99,  226 => 98,  219 => 93,  213 => 91,  211 => 90,  206 => 88,  203 => 87,  197 => 84,  194 => 83,  192 => 82,  189 => 81,  187 => 78,  186 => 75,  183 => 73,  176 => 69,  172 => 68,  165 => 67,  159 => 65,  156 => 64,  150 => 62,  144 => 61,  142 => 60,  138 => 58,  132 => 56,  130 => 55,  127 => 54,  121 => 52,  119 => 51,  116 => 50,  110 => 48,  108 => 47,  104 => 45,  96 => 44,  90 => 42,  88 => 41,  84 => 39,  78 => 36,  75 => 35,  73 => 34,  66 => 33,  63 => 31,  61 => 28,  60 => 25,  57 => 23,  55 => 22,);
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
 * Default product template.
 *
 * Available variables:
 * - attributes: HTML attributes for the wrapper.
 * - product: The rendered product fields.
 *   Use 'product' to print them all, or print a subset such as
 *   'product.title'. Use the following code to exclude the
 *   printing of a given field:
 *   @code
 *   {{ product|without('title') }}
 *   @endcode
 * - product_entity: The product entity.
 * - product_url: The product URL.
 *
 * @ingroup themeable
 */
#}
{% if view_mode == 'teaser' %}

  {%
    set classesTeaser = [
      'product',
      'product--teaser',
      'product--teaser--' ~ product_entity.title.value|clean_class
    ]
  %}

  {# Product teaser. #}
  <a href=\"{{ product_url }}\" {{ attributes.addClass(classesTeaser) }} aria-label=\"product_entity.title.value\">
    {% if product.field_add_on_products['#items'] %}
      <div class=\"add-on-item__teaser-flag\">
        {{ 'Bundle<br>Available!'|t }}
      </div>
    {% endif %}

    <div class=\"product__thumbnail\">
      {% if product.field_catalog_image|render|trim is not empty %}
        {{ product.field_catalog_image }}
      {% else %}
        <img src=\"{{ base_path ~ directory }}/gfx/i1.jpg\" class=\"no-product-thumbnail\" alt=\"{{ product_entity.title.value }}\" />
      {% endif %}\t
\t  
{% if 'True' in product.variation_field_sk|field_value [0]%}
<div class=\"sk\">{{ 'skidka'|t }}</div>
{% endif %}

{% if 'True' in product.variation_field_nov|field_value [0]%}
<div class=\"sk2\">{{ 'nowinka'|t }}</div>
{% endif %}

{% if 'True' in product.variation_field_rek|field_value [0]%}
<div class=\"sk1\">{{ 'rekomend'|t }}</div>
{% endif %}

    </div>
\t{% if product.variation_field_upak|field_value is not empty %}
<div class=\"ves_ed\">{{ product.variation_field_upak|field_value }}</div>
 {% else %}<div class=\"ves_ed\">{{ \"Под заказ\" }}</div>
{% endif %}
    {% if product.variation_field_original_price[0]['#markup'] %}
      {{ product.variation_field_original_price|field_value }}
    {% endif %}
    {{ product.variation_list_price }}    {{ product.variation_field_skd|field_value }}
    {{ product.variation_price }}
    {{ product.title }}
 
</a>
{% else %}

  {%
    set classesFull = [
      'product',
      'product--full',
      'product--full--' ~ product_entity.title.value|clean_class
    ]
  %}

  {# Product full page. #}        {# Share. #}
        <div class=\"sharethis-inline-share-buttons\"></div>
  <article{{ attributes.addClass(classesFull) }}>
    <div class=\"row\">
      <div class=\"col-xs-12 back-and-share\">
        {# Back button. #}\t
        <a href=\"/products\" class=\"back-to-products\">{{ 'Back to Products'|t }}</a>

{% if product.field_osb_sem|field_value is not empty %}
<div class=\"oso\">{{ product.field_osb_sem|field_value|safe_join('|') }}</div> 
{% endif %}

      </div>\t\t
    </div>

    <div class=\"row\">
      {% if product_variation_images %}
        {# Product images. #}
        {{ attach_library('magnific_popup/magnific_popup') }}

        {# Set product slider class. #}
        {% if product_variation_images|length <= 1 or product_entity.bundle == 'mason_jar' %}
          {% set product_slider_class = 'product-slider product-slider--no-thumbnails' %}
        {% else %}
          {% set product_slider_class = 'product-slider' %}
        {% endif %}

        <div class=\"col-sm-12 col-md-6\">
          {# Main product image - with slider. #}
          <div class=\"{{ product_slider_class }}\">
            <div class=\"product-slider__main-slider\">
              {% for product_variation in product_variation_images %}
                {% for product_variation_image in product_variation.images %}
                  {# Set product thumbnail. #}
                  {%
                    set product_slider_image_thumbnail = {
                    '#theme':      'image_style',
                    '#style_name': 'product_large',
                    '#uri':        product_variation_image.entity.uri.value,
                    '#alt':        product_variation_image.alt,
                  }
                  %}
                  <div>
                    <div class=\"product-slider__main-slider__item\">
                      <a href=\"{{ file_url(product_variation_image.entity.uri.value) }}\" class=\"magnific-popup-gallery\">
                        <span>{{ product_slider_image_thumbnail }}</span>
                      </a>
                    </div>
                  </div>
                {% endfor %}
              {% endfor %}
            </div>

            {# Image thumbnails. #}
            <div class=\"product-slider__nav-slider\">
              {% for product_variation in product_variation_images %}
                {% if product_variation.variation_id %}
                  {% set product_variation_id = product_variation.variation_id %}
                {% else %}
                  {% set product_variation_id = '' %}
                {% endif %}

                {% for product_variation_image in product_variation.images %}
                  {# Set product thumbnail. #}
                  {%
                    set product_slider_image_thumbnail = {
                    '#theme':      'image_style',
                    '#style_name': 'product_thumb',
                    '#uri':        product_variation_image.entity.uri.value,
                    '#alt':        product_variation_image.alt,
                  }
                  %}
                  <div>
                    <a class=\"product-slider__nav-slider__item\" data-product-variation-id=\"{{ product_variation_id }}\">
                      <span>{{ product_slider_image_thumbnail }}</span>
                    </a>
                  </div>
                {% endfor %}
              {% endfor %}
            </div>
          </div>
        </div>
        {# Product intro (w/ product images). #}
        <div class=\"col-sm-12 col-md-6\">
          <div class=\"product__intro\">
      {% else %}
        {# Product intro (w/o product images). #}
        <div class=\"col-sm-12\">
          <div class=\"product__intro product__intro--full-width\">
      {% endif %}

<div class=\"block1\">{{ product.field_brand }}
            <h1 class=\"page-title\">{{ product_entity.title.value }}</h1>
            {{ product.field_short_description|field_value }}</div> 
<div class=\"block2\">
  <div class=\"blockx1\">{{ product.variation_list_price }}{{ product.variation_price }}\t
\t\t    
{% if product.variation_price|field_value is null %}

  {% else %}
 <div class=\"est\">{{ product.variation_field_est|field_value }}</div>
{% endif %}

{% if product.variation_price|field_value is null %}
 {{ drupal_entity('block', 'semyannet') }}
  {% else %}
  {{ product.variations }}
{% endif %}

\t\t

\t\t</div>
  <div class=\"blockx2\">

  
\t{% if product.field_f1|field_value is not empty %}
<div class=\"oni_x\">{{ product.field_f1|field_value }}</div> 
{% endif %} 
\t{% if product.field_seriya|field_value is not empty %}
<div class=\"oni_x2\">{{ product.field_seriya|field_label  }}:  {{ product.field_seriya|field_value }}</div>
{% endif %}  \t

      \t{% if product.field_str_s|field_value is not empty %}
<div class=\"oni_x2\">{{ product.field_str_s|field_label  }}: {{ product.field_str_s|field_value }}</div>
{% endif %}
\t{% if product.field_pro_l|field_value is not empty %}
<div class=\"oni_x2\">{{ product.field_pro_l|field_label }}:  {{ product.field_pro_l|field_value }}</div> 
{% endif %}



\t{% if product.field_f_pl|field_value is not empty %}
<div class=\"oni_x\">{{ product.field_f_pl|field_value }} </div>
{% endif %}
\t{% if product.field_cv_pl|field_value is not empty %}
<div class=\"oni_x\"> {{ product.field_cv_pl|field_value }} </div>
{% endif %}\t
\t

\t{% if product.field_osb_sem|field_value is not empty %}
<div class=\"oni_x\">{{ product.field_osb_sem|field_value|safe_join(', ') }}</div> 
{% endif %}

\t{% if product.variation_field_gar|field_value is not empty %}
<div class=\"oni_x2\">{{ product.variation_field_gar|field_label  }}: {{ product.variation_field_gar|field_value }}</div>
{% endif %}

\t{% if product.field_hr|field_value is not empty %}
<div class=\"oni_x\">{{ product.field_hr|field_label }}: {{ product.field_hr|field_value|safe_join('|') }}</div> 
{% endif %}
\t{% if product.field_ir|field_value is not empty %}
<div class=\"oni_x\">{{ product.field_ir|field_label }}: {{ product.field_ir|field_value|safe_join('|') }}</div> 
{% endif %}
{{ product.field_sv_ter|field_value|safe_join('|') }}
</div>
</div>
<div class=\"block3\">{{ product.field_sroki }}</div> 

</div>
</div> 

    <div class=\"row\">
      <div class=\"col-sm-12\">


<script src=\"//code.jquery.com/jquery-1.11.1.min.js\"></script>
<!------ Include the above in your HEAD tag ---------->

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"panel-group\" id=\"accordion\">
                
\t\t\t\t\t\t\t{% if product.body|render|trim is not empty %}
\t\t\t\t<div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\"><span class=\"glyphicon glyphicon-file\">
                            </span> {{ 'Description'|t }}</a>
                        </h4>
                    </div>
                    <div id=\"collapseOne\" class=\"panel-collapse collapse in\">
                       <div class=\"active\"> {{ product.body }}</div>
                    </div>
                </div>
\t\t\t\t {% endif %}
\t\t\t\t
\t\t\t\t            {% if product.field_specifications|render|trim is not empty %}
                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse0\"><span class=\"glyphicon glyphicon-th-list\">
                            </span>  {{ 'Specifications'|t }}</a>
                        </h4>
                    </div>
                    <div id=\"collapse0\" class=\"panel-collapse collapse\">
                        <div class=\"active\">  {{ product.field_specifications }}
                    </div>
                </div>
                          {% endif %}
\t\t\t\t
\t\t\t\t
\t\t\t\t
\t\t\t\t{% if product.field_vi_o1|render|trim is not empty %}
                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\"><span class=\"glyphicon glyphicon-facetime-video\">
                            </span> {{ 'Video'|t }}</a>
                        </h4>
                    </div>
                    <div id=\"collapseTwo\" class=\"panel-collapse collapse\">
                     <div class=\"active\">    {{ product.field_vi_o }}
                    </div>
                </div>
\t\t\t\t{% endif %}
\t\t\t\t
\t\t\t\t
\t\t\t\t<div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse3\"><span class=\"glyphicon glyphicon-th-list\">
                            </span>{{ 'Other things'|t }}</a>
                        </h4>
                    </div>
                    <div id=\"collapse3\" class=\"panel-collapse collapse in\">
                      <div class=\"block2\"><div class=\"blockx3\">{{ drupal_entity('block', 'views_media_block_2') }}{{ drupal_entity('block', 'views_media_block_4') }}
\t\t\t\t\t  {{ drupal_entity('block', 'views_stati_v_to_block_1') }}</div>
\t\t\t\t\t  <div class=\"blockx2\">{{ product.field_vi_o }}</div>
                    </div>
                </div>
\t\t\t\t
\t\t\t\t
\t\t\t\t
\t\t\t\t<div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"active\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse4\"><span class=\"glyphicon glyphicon-heart\">
                            </span>   {{ 'Reviews'|t }} <span class=\"badge\">{{ product_reviews_count }}</span></a>
                        </h4>
                    </div>
                    <div id=\"collapse4\" class=\"panel-collapse collapse in\">
\t\t\t<div class=\"block2\">\t\t
             <div class=\"active\"> 
              <input type=\"checkbox\" id=\"submit-review\">
              <label class=\"btn btn-primary btn-sm\" for=\"submit-review\">{{ 'Submit a Review'|t }}</label>
              <div class=\"review-rating\">
                <p>{{ 'Overall Rating'|t }}</p>
                <span class=\"{{ rating_average >= 1 ? 'filled' : ''}}\"></span>
                <span class=\"half {{ rating_average >= 1.5 ? 'filled' : ''}}\"></span>
                <span class=\"{{ rating_average >= 2 ? 'filled' : ''}}\"></span>
                <span class=\"half {{ rating_average >= 2.5 ? 'filled' : ''}}\"></span>
                <span class=\"{{ rating_average >= 3 ? 'filled' : ''}}\"></span>
                <span class=\"half {{ rating_average >= 3.5 ? 'filled' : ''}}\"></span>
                <span class=\"{{ rating_average >= 4 ? 'filled' : ''}}\"></span>
                <span class=\"half {{ rating_average >= 4.5 ? 'filled' : ''}}\"></span>
                <span class=\"{{ rating_average == 5 ? 'filled' : ''}}\"></span>
              </div>
              {{ product.field_product_reviews }}
            </div>
                    </div>
                </div>
\t\t\t</div>\t
            </div>
        </div>
    </div>
</div>



    {# Recommended products. #}
    {% if product.field_recommended_products|render|trim is not empty %}
      <div class=\"row\">
        <div class=\"col-sm-12\">
          <div class=\"recommended-products\">
            {{ product.field_recommended_products }}
          </div>
        </div>
      </div>
    {% endif %}
  </article>

{% endif %}", "themes/custom/shopZ/templates/commerce/commerce-product--semena.html.twig", "/h/shopsakataby/htdocs/web/themes/custom/shopZ/templates/commerce/commerce-product--semena.html.twig");
    }
}
