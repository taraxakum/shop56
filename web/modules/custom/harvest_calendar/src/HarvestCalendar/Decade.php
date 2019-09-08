<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\HarvestCalendar;

class Decade {

  /** @var string */
  private $decade;

  /** @var string */
  private $part;

  /** @var string */
  private $month;

  /** @var string */
  private $period;

  /**
   * Decade constructor.
   *
   * @param string $decade
   *   The decade value.
   */
  public function __construct(string $decade) {
    $this->decade = $decade;
    $this->part = DecadeFactory::partFromDecade($decade);
    $this->month = DecadeFactory::monthFromDecade($decade);
    $this->period = DecadeFactory::periodFromDecade($decade);
  }

  public function monthNumber() {
    return \DateTime::createFromFormat('!F', $this->month)->format('n');
  }

  public function monthShort() {
    return \DateTime::createFromFormat('!F', $this->month)->format('M');
  }

  public function id(): string {
    return $this->decade;
  }

  public function name(): string {
    return sprintf('%s of %s', $this->part, $this->month);
  }

  public function contains(string $value): bool {
    return (bool) stristr($value, $this->decade);
  }

}
