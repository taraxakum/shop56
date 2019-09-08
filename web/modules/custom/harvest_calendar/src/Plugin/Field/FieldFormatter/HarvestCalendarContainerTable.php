<?php

namespace Drupal\harvest_calendar\Plugin\Field\FieldFormatter;

use Drupal\Core\Block\BlockManagerInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\harvest_calendar\HarvestCalendar\Decade;
use Drupal\harvest_calendar\HarvestCalendar\DecadeCeil;
use Drupal\harvest_calendar\HarvestCalendar\DecadeFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'harvest_calendar_formatter_table' formatter.
 *
 * @FieldFormatter(
 *   id = "harvest_calendar_formatter_table",
 *   label = @Translation("Harvest Calendar Table"),
 *   field_types = {
 *     "harvest_calendar_container",
 *   }
 * )
 */
class HarvestCalendarContainerTable extends FormatterBase implements ContainerFactoryPluginInterface {

  /**
   * The block manager.
   *
   * @var \Drupal\Core\Block\BlockManagerInterface
   */
  private $blockManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    $plugin_id,
    $plugin_definition,
    FieldDefinitionInterface $field_definition,
    array $settings,
    $label,
    $view_mode,
    array $third_party_settings,
    BlockManagerInterface $blockManager
  ) {
    $this->blockManager = $blockManager;

    parent::__construct(
      $plugin_id,
      $plugin_definition,
      $field_definition,
      $settings,
      $label,
      $view_mode,
      $third_party_settings
    );

  }

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition
  ) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.block')
    );
  }

  /**
   * Checks if the calendar field is enabled.
   *
   * @param $calendar
   *   The calendar.
   *
   * @return bool
   *   Flag.
   */
  private function calendarIsEnabled($calendar): bool {
    // ToDo: Remove when all fields are updated.
    if (!is_array($calendar)) {
      return FALSE;
    }

    return (bool) $calendar['field'] ?? NULL;
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
    uasort($fields, function ($a, $b) {
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
   * Merges arrays of fields and calendars.
   *
   * @param array $calendars
   *   Settings of container.
   * @param array $fields
   *   Entity fields.
   *
   * @return array
   *   Intersected list of fields, sorted by weight.
   */
  private function intersectFields(array $calendars, array $fields): array {
    $result = [];
    foreach ($this->sortFieldsByWeight($calendars) as $calendarId => $calendar) {
      if (isset($fields[$calendarId]) && $this->calendarIsEnabled($calendar)) {
        $result[$calendarId] = $fields[$calendarId];
      }
    }

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    // ToDo: Refactor method.
    $elements = [];
    $values = [];

    $entity = $items->getEntity();
    $calendars = $this->getFieldSetting('fields');
    $fields = $this->intersectFields($calendars, $entity->getFields());

    /** @var \Drupal\Core\Field\FieldItemList $field */
    foreach ($fields as $key => $field) {
      if (!$field->isEmpty()) {
        $values[$key] = $field;
      }
    }

    if (isset($items[0])) {
      /** @var \Drupal\Core\Field\FieldItemInterface $item */
      $field = $items[0];
      $show = $field->getValue()['value'];

      if ($show) {
        $elements[0] = $this->viewValue($values);
      }
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param array $fields
   *   Values of calendar fields.
   *
   * @return array
   *   Renderable array of table.
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginException
   *
   * @todo Refactor
   */
  protected function viewValue(array $fields): array {
    if ($fields) {
      return $this->viewValueForFields($fields);
    }

    return $this->viewValueForPlaceholder();
  }

  /**
   * Build a view date for a block.
   *
   * @return array
   *   Renderable array of a block.
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginException
   */
  protected function viewValueForPlaceholder(): array {
    $output = [];
    $blockId = $this->getFieldSetting('block');

    if ($blockId) {
      /** @var \Drupal\block_content\Plugin\Block\BlockContentBlock $block */
      $block = $this->blockManager->createInstance($blockId);
      $output = $block->build();
    }

    return $output;
  }

  /**
   * Build a view date for a Harvest calendar table.
   *
   * @param array $fields
   *   Values of calendar fields.
   *
   * @return array
   *   Renderable array of table.
   */
  protected function viewValueForFields(array $fields): array {
    $calendars = [];
    $decades = DecadeFactory::decadesAsCalendar();
    $months = \array_map(function ($month) {
      $name = \DateTime::createFromFormat('!F', $month)->format('M');
      return $this->t($name, [], ['context' => 'Abbreviated month name']);
    }, DecadeFactory::monthsAsCalendar());

    /** @var \Drupal\Core\Field\FieldItemList $field */
    foreach ($fields as $key => $field) {
      $color = $field->getSetting('color');
      $value = $field->getValue()[0]['value'];
      $calendars[$key] = [
        'name' => $field->getFieldDefinition()->getLabel(),
        'decades' => \array_map(function (Decade $decade) use ($color, $value) {
          return new DecadeCeil($decade, $color, $value);
        }, $decades),
        'color' => $color,
      ];
    }

    $output = [
      '#theme' => 'harvest_calendar_table',
      '#months' => $months,
      '#decades' => $decades,
      '#calendars' => $calendars,
    ];

    return $output;
  }

}
