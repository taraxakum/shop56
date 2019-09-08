<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\HarvestCalendar;

use Drupal\harvest_calendar\HarvestCalendar\Exception\FailedArrayJoin;
use Drupal\harvest_calendar\HarvestCalendar\Exception\UndefinedDecade;

/**
 * Class DecadeFactory.
 */
class DecadeFactory {

  /**
   * The decade period names.
   *
   * See an explanation table below to get understood.
   *
   * -------------------------------------------------------------------------
   * |        0        |        1        |        2        |        3        |
   * |       spr       |       sum       |       aut       |       win       |
   * -------------------------------------------------------------------------
   * |  0  |  1  |  2  |  3  |  4  |  5  |  6  |  7  |  8  |  9  |  10 |  11 |
   * | mar | apr | may | jun | jul | aug | sep | oct | nov | dec | jan | feb |
   * |  3  |  4  |  5  |  6  |  7  |  8  |  9  |  10 |  11 |  12 |  1  |  2  |
   * -------------------------------------------------------------------------
   * | | | | |#|#|#|#|#|#| | | | | | | | | | | | | | | | | | | | | | | | | | |
   * -------------------------------------------------------------------------
   * | | | | | | | |#|#|#|#|#|#| | | | | | | | | | | | | | | | | | | | | | | |
   * -------------------------------------------------------------------------
   * | | | | | | | | | |#|#|#|#|#|#|#|#| | | | | | | | | | | | | | | | | | | |
   * -------------------------------------------------------------------------
   * |0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F|G|H|I|G|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z|
   * -------------------------------------------------------------------------
   *
   * @var array
   */
  private const DECADES = [
    '0', '1', '2', '3', '4', '5', '6', '7', '8',
    '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
    'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q',
    'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
  ];

  private const MONTHS = [
    'MARCH',     'APRIL',   'MAY',
    'JUNE',      'JULY',    'AUGUST',
    'SEPTEMBER', 'OCTOBER', 'NOVEMBER',
    'DECEMBER',  'JANUARY', 'FEBRUARY',
  ];

  private const PERIODS = [
    'SPRING',
    'SUMMER',
    'AUTUMN',
    'WINTER',
  ];

  /**
   * Build a flat list of decades.
   *
   * @return array
   */
  public static function flatDecades(): array {
    return \array_map(function ($decade) {
      return new Decade($decade);
    }, self::DECADES);
  }

  /**
   * Returns all decades sorted in the calendar sequence.
   *
   * @return array
   */
  public static function decadesAsCalendar(): array {
    $flatDecades = self::flatDecades();
    $decades = \array_splice($flatDecades, -6);
    \array_push($decades, ...$flatDecades);

    return $decades;
  }

  /**
   * Returns all months sorted in the calendar sequence.
   *
   * @return array
   */
  public static function monthsAsCalendar(): array {
    $hcMonths = self::MONTHS;
    $months = \array_splice($hcMonths, -2);
    \array_push($months, ...$hcMonths);

    return $months;
  }

  /**
   * Build the tree of decades hierarchy.
   *
   * @return array
   *   Returns an array with full hierarchy.
   */
  public static function treeWithPeriods(): array {
    $periods = self::PERIODS;
    $months = self::MONTHS;
    $decades = self::flatDecades();

    $monthTree = self::chunk($months, $decades);
    $tree = self::chunk($periods, $monthTree);

    return $tree;
  }

  /**
   * Splits items by appropriate chunks.
   *
   * @param array $parent
   * @param array $children
   *
   * @return array
   */
  public static function chunk(array $parent, array $children): array {
    $tree = [];
    $parentQuantity = \count($parent);
    $childrenQuantity = \count($children);

    if ($childrenQuantity % $parentQuantity !== 0) {
      FailedArrayJoin::fromQuantities($parentQuantity, $childrenQuantity);
    }

    $chunk = \array_chunk($children, $childrenQuantity / $parentQuantity, TRUE);
    foreach ($parent as $k => $item) {
      $value = new \stdClass();
      $value->name = self::namePrettier($item);
      $value->id = $k + 1;
      $value->children = $chunk[$k];

      $tree[$k] = $value;
    }

    return $tree;
  }

  /**
   * Get the name of month by the decade value.
   *
   * @param string $decade
   *   The value of decade.
   *
   * @return string
   *   The name of month.
   *
   * @throws \Drupal\harvest_calendar\HarvestCalendar\Exception\UndefinedDecade
   */
  public static function monthFromDecade(string $decade): string {
    $index = self::findIndex($decade);

    $monthIndex = \intdiv((int) $index, 3);

    return self::namePrettier(self::MONTHS[$monthIndex]);
  }

  /**
   * Get the part name of decade by the value.
   *
   * @param string $decade
   *   The value of decade.
   *
   * @return string
   *   The part name of decade.
   *
   * @throws \Drupal\harvest_calendar\HarvestCalendar\Exception\UndefinedDecade
   */
  public static function partFromDecade(string $decade): string {
    $index = self::findIndex($decade);

    $parts = ['START', 'MIDDLE', 'END'];
    $partIndex = $index % 3;

    return self::namePrettier($parts[$partIndex]);
  }

  /**
   * Get the name of period by the decade value.
   *
   * @param string $decade
   *   The value of decade.
   *
   * @return string
   *   The name of period.
   *
   * @throws \Drupal\harvest_calendar\HarvestCalendar\Exception\UndefinedDecade
   */
  public static function periodFromDecade(string $decade): string {
    $index = self::findIndex($decade);

    $periodIndex = \intdiv((int) $index, 9);

    return self::namePrettier(self::PERIODS[$periodIndex]);
  }

  /**
   * Prettify uppercase name to ucfirst.
   *
   * @param string $item
   *
   * @return string
   */
  private static function namePrettier(string $item): string {
    return \ucfirst(\mb_strtolower($item));
  }

  /**
   * Splits a string by decades.
   *
   * @param string $string The string that contains aa decades set.
   *
   * @return array
   */
  public static function decadesFromString(string $string): array {
    $parts = \str_split($string);

    if (FALSE === $parts) {
      return [];
    }

    $items = \array_unique(\array_map('mb_strtoupper', $parts));
    $decades = \array_filter($items, [self::class, 'validateDecade']);

    return $decades;
  }

  /**
   * Validate decade value by the decade name.
   *
   * @param string $decade A decade value.
   *
   * @return bool
   */
  public static function validateDecade($decade): bool {
    try {
      self::findIndex($decade);
    } catch (UndefinedDecade $exception) {
      $decade = NULL;
    }

    return NULL !== $decade;
  }

  /**
   * Finds the index of decade in storage.
   *
   * @param string|int $decade A decade value.
   *
   * @return int The index of decade.
   *
   * @throws \Drupal\harvest_calendar\HarvestCalendar\Exception\UndefinedDecade
   */
  private static function findIndex($decade): int {
    $index = \array_search($decade, self::DECADES);

    if (FALSE === $index) {
      throw UndefinedDecade::fromDecade($decade);
    }

    return $index;
  }

}
