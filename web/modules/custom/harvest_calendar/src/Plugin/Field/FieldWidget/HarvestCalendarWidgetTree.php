<?php

namespace Drupal\harvest_calendar\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\harvest_calendar\HarvestCalendar\DecadeFactory;

/**
 * Plugin implementation of the 'harvest_calendar_widget_tree' widget.
 *
 * @FieldWidget(
 *   id = "harvest_calendar_widget_tree",
 *   label = @Translation("Tree of harvest calendar"),
 *   field_types = {
 *     "harvest_calendar"
 *   }
 * )
 */
class HarvestCalendarWidgetTree extends WidgetBase {

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
      '#type' => 'harvest_calendar_tree',
      '#value' => $items[$delta]->value ?? NULL,
    ];

    return ['value' => $element];
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(
    array $values,
    array $form,
    FormStateInterface $form_state
  ) {
    foreach ($values as $k => $value) {
      $str = \implode('', \array_filter($value['value'], function ($decade) {
        // ToDo: Figure out how to validate zero value in most right way.
        return \is_string($decade) && DecadeFactory::validateDecade($decade);
      }));
      $values[$k] = $str;
    }

    return parent::massageFormValues($values, $form, $form_state);
  }

}
