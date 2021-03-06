<?php

/**
 * @file
 * Theme preprocess functions for the commerce_pos_reports module.
 */

use Drupal\Core\Render\Element;
use Drupal\commerce_pos\Entity\Register;

/**
 * @file
 * commerce_pos_reports.theme.inc
 */

/**
 * Theme callback for the end of day results table.
 */
function template_preprocess_commerce_pos_reports_end_of_day_result_table(&$variables) {
  $renderer = \Drupal::service('renderer');

  // Get the useful values.
  $form = $variables['form'];
  $rows = $form['rows'];
  $header = $form['#header'];

  // Setup the structure to be rendered and returned.
  $content = [
    '#theme' => 'table',
    '#header' => $header,
    '#rows' => [],
  ];

  // Traverse each row.
  foreach (Element::children($rows) as $row_index) {
    $row = [];
    // Traverse each column in the row.  @see element_children().
    foreach (Element::children($rows[$row_index]) as $col_index) {
      // Render the column form element.
      if (is_array($rows[$row_index][$col_index])) {
        $row[] = $renderer->render($rows[$row_index][$col_index]);
      }
    }
    // Add the row to the table.
    $content['#rows'][] = $row;
  }

  // Render the table and return.
  $variables['form'] = $content;
}

/**
 * Implements template_preprocess_commerce_pos_reports_receipt().
 */
function template_preprocess_commerce_pos_reports_receipt(&$variables) {
  $date = $variables['date'];

  // Get register name.
  $register_id = $variables['register'];
  $register = Register::load($register_id);
  $variables['register'] = $register->label();

  // Populate the arrays with the POS Payment methods.
  $pos_methods = commerce_pos_reports_get_payment_gateway_options($variables['date']);

  list($totals, $transaction_counts, $transaction_summary) = commerce_pos_reports_get_totals($date, $register_id, $pos_methods);
  $results = commerce_pos_reports_get_eod_report($date, $register_id);

  $currency_formatter = \Drupal::service('commerce_price.currency_formatter');

  $variables['rows'] = [];

  foreach ($totals as $currency_code => $currency_totals) {
    foreach ($currency_totals as $payment_method_id => $amounts) {
      $row = [];

      // Determine if this is a cash payment method.
      $is_cash = $payment_method_id == 'pos_cash';

      $expected_amount = $amounts;

      if ($is_cash) {
        $register = Register::load($register_id);
        $expected_amount += $register->getOpeningFloat()->getNumber();
      }

      $declared = $results['data'][$payment_method_id]['declared'];

      $row['title'] = $pos_methods[$payment_method_id];
      $row['total_transactions'] = $transaction_counts[$payment_method_id];
      $row['declared'] = $currency_formatter->format((string) $declared, $currency_code);
      $row['expected'] = $currency_formatter->format((string) $expected_amount, $currency_code);
      $row['over_short'] = $currency_formatter->format((string) ($declared - $expected_amount), $currency_code);
      if (isset($results['data'][$payment_method_id]['cash_deposit']) && !empty($results['data'][$payment_method_id]['cash_deposit'])) {
        $row['cash_deposit'] = $currency_formatter->format((string) $results['data'][$payment_method_id]['cash_deposit'], $currency_code);
      }

      $row['transaction_summary'] = $transaction_summary[$payment_method_id];

      $variables['rows'][] = $row;
    }
  }
}
