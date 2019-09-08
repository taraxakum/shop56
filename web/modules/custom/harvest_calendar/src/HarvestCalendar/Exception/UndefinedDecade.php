<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\HarvestCalendar\Exception;

class UndefinedDecade extends HarvestCalendarException {

  /**
   * Throw an exception by undefined decade name.
   *
   * @param string $decade
   *   The index value.
   *
   * @return self
   *   Current exception.
   */
  public static function fromDecade(string $decade): self {
    return new self(sprintf('There no decades such a "%s"', $decade));
  }

}
