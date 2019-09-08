<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\HarvestCalendar;

use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Provides a wrapper for Decades to use it in templates.
 *
 * @package Drupal\harvest_calendar\HarvestCalendar
 */
class DecadeCeil {

  /**
   * A Decade.
   *
   * @var \Drupal\harvest_calendar\HarvestCalendar\Decade
   */
  private $decade;

  /**
   * Decade's value.
   *
   * @var string
   */
  private $value;

  /**
   * Calendar color.
   *
   * @var string
   */
  private $color;

  /**
   * Renderable array.
   *
   * @var array
   */
  private $ceil;

  /**
   * DecadeCeil constructor.
   *
   * @param \Drupal\harvest_calendar\HarvestCalendar\Decade $decade
   *   A Decade definition.
   * @param string $color
   *   Calendar color.
   * @param string $value
   *   Decade's value.
   */
  public function __construct(
    Decade $decade,
    string $color = 'transparent',
    string $value = ''
  ) {
    $this->decade = $decade;
    $this->color = $color;
    $this->value = $value;
    $this->ceil = $this->build();
  }

  /**
   * Build the ceil.
   *
   * @return array
   *   Renderable array.
   */
  private function build(): array {
    $color = $this->isActive() ? $this->color : 'inherit';

    return [
      '#theme' => 'harvest_calendar_table_ceil',
      '#background_color' => $color,
      '#color' => $this->color,
      '#title' => new TranslatableMarkup($this->decade->name(), [], ['context' => 'HarvestCalendar']),
    ];
  }

  /**
   * Checks if decade is in value.
   *
   * @return bool
   *   The flag.
   */
  public function isActive() {
    return $this->decade->contains($this->value);
  }

  /**
   * Get renderable ceil.
   *
   * @return array
   *   Renderable array.
   */
  public function getCeil(): array {
    return $this->ceil;
  }

}
