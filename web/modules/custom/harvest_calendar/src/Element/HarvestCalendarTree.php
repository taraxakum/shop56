<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\CompositeFormElementTrait;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\harvest_calendar\HarvestCalendar\DecadeFactory;

/**
 * Provides a form element for a harvest calendar hierarchy.
 *
 * @FormElement("harvest_calendar_tree")
 */
class HarvestCalendarTree extends FormElement {

  use CompositeFormElementTrait;

  /**
   * Returns the element properties for this element.
   *
   * @return array
   *   An array of element properties. See
   *   \Drupal\Core\Render\ElementInfoManagerInterface::getInfo() for
   *   documentation of the standard properties of all elements, and the
   *   return value format.
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#theme' => 'harvest_calendar_element_tree',
      '#label' => 'Harvest calendar hierarchy',
      '#description' => "The harvest calendar marked by it's hierarchy",
      '#process' => [
        [$class, 'processHierarchy'],
      ],
      '#pre_render' => [
        [$class, 'preRenderCompositeFormElement'],
      ],
    ];
  }

  public static function processHierarchy(
    &$element,
    FormStateInterface $form_state,
    &$complete_form
  ) {
    $value = is_string($element['#value']) ? $element['#value'] : '';
    $element['#harvest_calendar_tree'] = DecadeFactory::treeWithPeriods();
    $flatDecades = DecadeFactory::flatDecades();

    /** @var \Drupal\harvest_calendar\HarvestCalendar\Decade $decade */
    foreach ($flatDecades as $decade) {
      $element[$decade->id()] = [
        '#type' => 'checkbox',
        '#title' => new TranslatableMarkup($decade->name(), [], ['context' => 'HarvestCalendar']),
        '#return_value' => $decade->id(),
        '#default_value' => $decade->contains($value),
      ];
    }

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function valueCallback(
    &$element,
    $input,
    FormStateInterface $form_state
  ) {
    $value = $input ? implode('', $input) : '';

    return $value;
  }

}
