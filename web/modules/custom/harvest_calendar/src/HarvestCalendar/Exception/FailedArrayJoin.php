<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\HarvestCalendar\Exception;

class FailedArrayJoin extends HarvestCalendarException {

  /**
   * Throws an exception of undividable array were joined.
   *
   * @param int $parentQuantity
   *   Count of the parent array items.
   * @param int $childrenQuantity
   *   Count of the children array items.
   *
   * @throws self
   */
  public static function fromQuantities(int $parentQuantity, int $childrenQuantity) {
    $message = 'Arrays must be dividable. Current quantities are: %d and %d';
    throw new self(
      sprintf($message, $parentQuantity, $childrenQuantity)
    );
  }

}
