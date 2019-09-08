<?php

namespace Drupal\harvest_calendar\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'harvest_calendar_container_widget' widget.
 *
 * @FieldWidget(
 *   id = "harvest_calendar_container_widget",
 *   label = @Translation("Container"),
 *   field_types = {
 *     "harvest_calendar_container",
 *   }
 * )
 */
class HarvestCalendarContainerWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta,
    array $element,
    array &$form,
    FormStateInterface $form_state
  ) {
    $element += [
      'value' => [
        '#type' => 'checkbox',
        '#title' => $this->t('Display container'),
        '#default_value' => $items[$delta]->value,
      ],
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  protected function formMultipleElements(
    FieldItemListInterface $items,
    array &$form,
    FormStateInterface $form_state
  ) {
    $elements = [
      '#is_harvest_calendar_container' => TRUE,
    ] + parent::formMultipleElements($items, $form, $form_state);

    return $elements;
  }

}
