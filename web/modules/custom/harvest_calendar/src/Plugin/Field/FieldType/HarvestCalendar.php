<?php

namespace Drupal\harvest_calendar\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'harvest_calendar' field type.
 *
 * @FieldType(
 *   id = "harvest_calendar",
 *   label = @Translation("Harvest calendar"),
 *   description = @Translation("The harvest calendar"),
 *   default_widget = "harvest_calendar_widget_tree",
 *   default_formatter = "harvesy_calendar_formatter",
 *   category = @Translation("Harvest Calendar"),
 *   cardinality = 1,
 * )
 */
class HarvestCalendar extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
        'color' => '#ff0000',
      ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
        'value' => '',
      ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(
    FieldStorageDefinitionInterface $field_definition
  ) {
    $schema = [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => 36,
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(
    FieldStorageDefinitionInterface $field_definition
  ) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Value'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(
    array $form,
    FormStateInterface $form_state
  ) {
    $element['color'] = [
      '#type' => 'color',
      '#title' => new TranslatableMarkup('Color'),
      '#default_value' => $this->getSetting('color'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(
    FieldDefinitionInterface $field_definition
  ) {
    $decades = \Drupal\harvest_calendar\HarvestCalendar\DecadeFactory::flatDecades();

    $count = \count($decades);
    $start = \mt_rand(0, $count - 7);
    $max = \mt_rand(2, 6);

    $value = \implode('', \array_unique(\array_map(function ($i) {
      /** @var \Drupal\harvest_calendar\HarvestCalendar\Decade $i */
      return $i->id();
    }, \array_slice($decades, $start, $max))));

    $values['value'] = $value;

    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}
