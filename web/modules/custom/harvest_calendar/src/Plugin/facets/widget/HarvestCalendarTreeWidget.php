<?php

declare(strict_types=1); // strict mode

namespace Drupal\harvest_calendar\Plugin\facets\widget;

use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\facets\FacetInterface;
use Drupal\facets\Plugin\facets\widget\LinksWidget;
use Drupal\harvest_calendar\HarvestCalendar\Decade;
use Drupal\harvest_calendar\HarvestCalendar\DecadeFactory;

/**
 * A widget to display the harvest_calendar_tree.
 *
 * @FacetsWidget(
 *   id = "harvest_calendar_tree_widget",
 *   label = @Translation("Harvest Calendar Tree"),
 *   description = @Translation("A widget to display the harvest calendar"),
 * )
 */
class HarvestCalendarTreeWidget extends LinksWidget {

  /**
   * {@inheritdoc}
   */
  public function build(FacetInterface $facet) {
    $flatDecades = DecadeFactory::flatDecades();
    $build = parent::build($facet);

    $mapResults = $this->mapResultsByHarvestCalendar(
      $build['#items'],
      $facet->getResults(),
      $flatDecades
    );

    $build['#attributes']['class'][] = 'js-facets-checkbox-links';
    $build['#attached']['library'][] = 'facets/drupal.facets.checkbox-widget';
    $build['#theme'] = 'harvest_calendar_element_tree';
    $build['#harvest_calendar_tree'] = DecadeFactory::treeWithPeriods();
    $build['#is_facet'] = TRUE;

    /** @var \Drupal\harvest_calendar\HarvestCalendar\Decade $decade */
    foreach ($flatDecades as $decade) {
      $build[$decade->id()] = $mapResults[$decade->id()]['result'];
    }

    return $build;
  }

  /**
   * Map the lists of decades and available items.
   *
   * @param array $items
   *   The list of facet links items.
   * @param array $results
   *   The list of facet results.
   * @param array $decades
   *   The list of facet decades.
   *
   * @return array
   *   Mapped list of valued to process.
   */
  private function mapResultsByHarvestCalendar(
    array $items,
    array $results,
    array $decades
  ): array {
    $output = [];
    $resultsMap = [];

    /** @var \Drupal\facets\Result\ResultInterface $result */
    foreach ($results as $i => $result) {
      $k = $result->getRawValue();
      $resultsMap[$k] = $items[$i];
    }

    /** @var \Drupal\harvest_calendar\HarvestCalendar\Decade $decade */
    foreach ($decades as $decade) {
      $id = $decade->id();
      $isAvailable = isset($resultsMap[$id]);
      $output[$id] = [
        'decade' => $decade,
        'result' => $isAvailable ? $resultsMap[$id] : $this->buildDisabledListItem($decade),
        'available' => $isAvailable,
      ];

      if ($isAvailable) {
        $output[$id]['result']['#title']['#value'] = $this->decadePrettyName($decade);
      }
    }

    return $output;
  }

  /**
   * Builds a disabled checkbox for unavailable decade item.
   *
   * @param \Drupal\harvest_calendar\HarvestCalendar\Decade $decade
   *   A decade definition.
   *
   * @return array
   *   A renderable array.
   */
  private function buildDisabledListItem(Decade $decade): array {
    return [
      '#type' => 'checkbox',
      '#title' => $this->decadePrettyName($decade),
      '#disabled' => TRUE,
      '#attributes' => [
        'title' => new TranslatableMarkup('Not available'),
        'class' => ['empty-decade'],
        'disabled' => 'disabled',
      ],
    ];
  }

  /**
   * Ptetifes and translates a decade name.
   *
   * @param \Drupal\harvest_calendar\HarvestCalendar\Decade $decade
   *   A decade definition.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   The translation.
   */
  private function decadePrettyName(Decade $decade): TranslatableMarkup {
    return new TranslatableMarkup($decade->name(), [], ['context' => 'HarvestCalendar']);
  }

}
