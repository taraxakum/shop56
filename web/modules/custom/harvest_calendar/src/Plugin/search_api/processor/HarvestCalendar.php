<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\Plugin\search_api\processor;

use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;
use Drupal\harvest_calendar\HarvestCalendar\DecadeFactory;
use Drupal\search_api\Item\FieldInterface;
use Drupal\search_api\Processor\FieldsProcessorPluginBase;

/**
 * Adds the item's harvest_calendar to the indexed data.
 *
 * @SearchApiProcessor(
 *   id = "add_harvest_calendar",
 *   label = @Translation("Harvest Calendar field"),
 *   description = @Translation("Adds item's of Harvest Calendar to index."),
 *   stages = {
 *     "pre_index_save" = 0,
 *     "preprocess_index" = 0,
 *     "preprocess_query" = 0,
 *   },
 * )
 */
class HarvestCalendar extends FieldsProcessorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(
    array $form,
    FormStateInterface $form_state
  ) {
    $fields = $this->index->getFields();
    $field_options = [];
    $default_fields = [];
    $all_fields = $this->configuration['all_fields'];
    $fields_configured = isset($this->configuration['fields']);
    if ($fields_configured && !$all_fields) {
      $default_fields = $this->configuration['fields'];
    }

    /** @var \Drupal\search_api\Item\FieldInterface $field */
    foreach ($fields as $name => $field) {
      if ($this->isHarvestCalendar($field)) {
        $field_options[$name] = Html::escape($field->getPrefixedLabel());
        if ($all_fields || (!$fields_configured && $this->testField($name,
              $field))) {
          $default_fields[] = $name;
        }
      }
    }

    $form['all_fields'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable on all supported fields'),
      '#description' => $this->t('Enable this processor for all supported fields. This will also automatically update the setting when new supported fields are added to the index.'),
      '#default_value' => $all_fields,
    ];

    // Unfortunately, Form API doesn't seem to automatically add the default
    // "#pre_render" callbacks to an element if we set some of our own. We
    // therefore need to explicitly include those, too.
    $pre_render = $this
      ->getElementInfoManager()
      ->getInfoProperty('checkboxes', '#pre_render', []);
    $pre_render[] = [static::class, 'preRenderFieldsCheckboxes'];

    $form['fields'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Enable this processor on the following fields'),
      '#description' => $this->t("Note: The Search API currently doesn't support per-field keywords processing, so this setting will be ignored when preprocessing search keywords. It is therefore usually recommended that you enable the processor for all fields that you intend to use as fulltext search fields, to avoid undesired consequences."),
      '#options' => $field_options,
      '#default_value' => $default_fields,
      '#pre_render' => $pre_render,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function preprocessIndexItems(array $items) {
    foreach ($items as $item) {
      /** @var \Drupal\search_api\Item\FieldInterface $field */
      foreach ($item->getFields() as $name => $field) {
        if ($this->testField($name, $field)) {
          $values = $field->getValues();
          foreach ($values as $value) {
            $decades = $this->splitDecades($value);
            $field->setValues($decades);
          }
          $this->processField($field);
        }
      }
    }
  }

  /**
   * Split decades value.
   *
   * @param string $value
   *   Text value of decade field.
   *
   * @return array
   *   Separated decades.
   */
  private function splitDecades(string $value): array {
    return DecadeFactory::decadesFromString($value);
  }

  /**
   * Check if the field is instance of harvest calendar.
   *
   * @param \Drupal\search_api\Item\FieldInterface $field
   *   Field definition.
   *
   * @return bool
   *   Whether is harvest_calendar or not.
   */
  private function isHarvestCalendar(FieldInterface $field) {
    return !$field->isTypeLocked()
      && !$field->isHidden()
      && $field->getOriginalType() === 'field_item:harvest_calendar';
  }

}
