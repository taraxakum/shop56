<?php

namespace Drupal\harvest_calendar\Plugin\Field\FieldType;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\TypedData\DataDefinitionInterface;
use Drupal\Core\TypedData\TypedDataInterface;

/**
 * Plugin implementation of the 'harvest_calendar_container' field type.
 *
 * @FieldType(
 *   id = "harvest_calendar_container",
 *   label = @Translation("Harvest calendar container"),
 *   description = @Translation("Joins the Harvest Calendar fields and displays
 *     them as a single value"),
 *   default_widget = "harvest_calendar_container_widget",
 *   default_formatter = "harvest_calendar_formatter_table",
 *   category = @Translation("Harvest Calendar"),
 *   cardinality = 1,
 * )
 */
class HarvestCalendarContainer extends FieldItemBase {

  /**
   * The block manager.
   *
   * @var \Drupal\Core\Block\BlockManagerInterface
   */
  protected $blockManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    DataDefinitionInterface $definition,
    $name = NULL,
    TypedDataInterface $parent = NULL
  ) {
    // Because of \Drupal\Core\TypedData doesn't supports regular DI
    // we need to inject BlockManagerInterface in a dirty way.
    // @see https://www.drupal.org/project/drupal/issues/2053415
    // If the issue above is already solved - it needs to be replaced
    // with the solution way.
    $this->blockManager = \Drupal::service('plugin.manager.block');

    parent::__construct($definition, $name, $parent);
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'value' => TRUE,
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    $settings = [
      'fields' => [],
      'block' => NULL,
    ] + parent::defaultFieldSettings();

    return $settings;
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
          'type' => 'int',
          'not null' => TRUE,
          'default' => 1,
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
    $properties['value'] = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Value'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(
    FieldDefinitionInterface $field_definition
  ) {
    $values['value'] = TRUE;

    return $values;
  }

  /**
   * Build blocks list.
   *
   * @return array
   *   Renderable array with available blocks.
   */
  public function buildBlocksChooser() {
    $definitions = $this->blockManager->getSortedDefinitions();
    $blocks = array_filter($definitions, function (array $definition) {
      return empty($definition['_block_ui_hidden']);
    });

    $options = [0 => $this->t('-- Select --')];
    foreach ($blocks as $plugin_id => $plugin_definition) {
      $options[$plugin_id] = $plugin_definition['admin_label'];
    }

    $build = [
      '#type' => 'select',
      '#title' => $this->t('Block replacement'),
      '#description' => $this->t('Choose block to replace empty values'),
      '#options' => $options,
      '#default_value' => $this->getSetting('block'),
    ];

    return $build;
  }

  /**
   * Sorts fields by weight.
   *
   * @param array $fields
   *   Fields list.
   *
   * @return array
   *   Sorted fields.
   */
  private function sortFieldsByWeight(array $fields): array {
    usort($fields, function ($a, $b) {
      // ToDo: Remove when all fields are updated.
      if (!isset($a['weight']) || !isset($b['weight'])) {
        return 0;
      }

      if ($a['weight'] == $b['weight']) {
        return 0;
      }
      return ($a['weight'] < $b['weight']) ? -1 : 1;
    });

    return $fields;
  }

  /**
   * Returns a list of harvest calendar's fields with their weight and status.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   An entity definition.
   *
   * @return array
   *   The list of fields.
   */
  private function getHarvestCalendarsByWeight(EntityInterface $entity): array {
    $result = [];
    $fields = $entity->getFields();

    /** @var \Drupal\Core\Field\FieldItemList $fieldList */
    foreach ($fields as $fieldList) {
      $field = $fieldList->getFieldDefinition();
      if ($field->getType() === 'harvest_calendar') {
        $name = $field->getName();
        $result[] = [
          'name' => $name,
          'label' => $field->getLabel(),
          'weight' => $this->fieldSetting($name, 'weight') ?? 0,
          'status' => $this->fieldSetting($name, 'field') ?? 0,
        ];
      }
    }

    return $this->sortFieldsByWeight($result);
  }

  /**
   * Build fields list.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   An entity definition.
   *
   * @return array
   *   Renderable array with available fields.
   *
   * @todo Refactor
   */
  public function buildFieldsChooser(EntityInterface $entity) {
    $build['table-row'] = [
      '#type' => 'table',
      '#header' => [$this->t('Field'), $this->t('Weight')],
      '#empty' => $this->t('No Harvest Calendar fields defined!'),
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'table-sort-weight',
        ],
      ],
    ];

    $harvestCalendars = $this->getHarvestCalendarsByWeight($entity);
    foreach ($harvestCalendars as $field) {
      $name = $field['name'];
      $label = $field['label'];
      $weight = $field['weight'];
      $status = $field['status'];

      $build['table-row'][$name]['#attributes']['class'][] = 'draggable';
      $build['table-row'][$name]['#weight'] = $weight;

      $build['table-row'][$name]['field'] = [
        '#type' => 'checkbox',
        '#title' => $label,
        '#default_value' => $status,
      ];

      $build['table-row'][$name]['weight'] = [
        '#type' => 'weight',
        '#title' => $this->t('Weight for @title', ['@title' => $label]),
        '#title_display' => 'invisible',
        '#default_value' => $weight,
        '#attributes' => ['class' => ['table-sort-weight']],
      ];
    }

    return $build;
  }

  /**
   * Returns a setting per field.
   *
   * @param string $fieldName
   *   The name of the field.
   * @param string $settingName
   *   The name of the setting.
   *
   * @return mixed
   *   Value of setting.
   */
  private function fieldSetting(string $fieldName, string $settingName) {
    return $this->getSetting('fields')[$fieldName][$settingName] ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(
    array $form,
    FormStateInterface $form_state
  ) {
    $element = [];

    $entity = $form['#entity'];
    $element['fields'] = $this->buildFieldsChooser($entity);
    $element['block'] = $this->buildBlocksChooser();

    return $element;
  }

  /**
   * Converts settings.
   *
   * @param array $settings
   *   Settings list.
   *
   * @return array
   *   Settings list.
   */
  public static function convertSettingsToSave(array $settings): array {
    $converted = $settings;
    if (!empty($converted['fields']['table-row'])) {
      $converted['fields'] = $converted['fields']['table-row'];
    }

    return $converted;
  }

  /**
   * {@inheritDoc}
   */
  public static function fieldSettingsToConfigData(array $settings) {
    $settings = self::convertSettingsToSave($settings);

    return parent::fieldSettingsToConfigData($settings);
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL;
  }

}
