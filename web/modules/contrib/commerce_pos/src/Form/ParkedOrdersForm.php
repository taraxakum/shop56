<?php

namespace Drupal\commerce_pos\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\user\Entity\User;

/**
 * Provides an order lookup form to search orders.
 */
class ParkedOrdersForm extends OrderLookupForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'commerce_pos_parked_order_lookup';
  }

  /**
   * Build the order lookup form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'commerce_pos/global';
    $form['#attached']['library'][] = 'commerce_pos/order_lookup';
    // The order search elements.
    $form['order_lookup'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Parked Order Lookup'),
    ];

    // The search box to look up by order number, customer name or email.
    $form['order_lookup']['search_box'] = [
      '#type' => 'textfield',
      '#maxlength' => 50,
      '#size' => 25,
      '#description' => $this->t('Filter by order number, customer name or customer email.'),
      '#ajax' => [
        'callback' => '::orderLookupAjaxRefresh',
        'event' => 'input',
        'progress' => [
          'type' => 'throbber',
          'message' => t('Searching parked orders...'),
        ],
      ],
    ];

    // Display the results of the lookup below.
    $form['order_lookup']['results'] = [
      '#type' => 'container',
      '#prefix' => '<div id="order-lookup-results">',
      '#suffix' => '</div>',
    ];

    $triggering_element = $form_state->getTriggeringElement();
    if (empty($triggering_element)) {
      $lookup_results = $this->searchOrderResults($form_state, '', 'parked', '=', $this->t('There are currently no parked orders'));

      $form['order_lookup']['results']['result'] = [
        '#type' => 'item',
        '#markup' => $lookup_results,
        '#prefix' => '<div id="order-lookup-results">',
        '#suffix' => '</div>',
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOrderTable(FormStateInterface $form_state, array $orders) {
    $currency_formatter = \Drupal::service('commerce_price.currency_formatter');

    $header = [
      t('Order ID'),
      t('Date'),
      t('Status'),
      t('Cashier'),
      t('Customer'),
      t('Contact Email'),
      t('Total'),
      t('Action'),
    ];

    $rows = [];
    foreach ($orders as $order) {

      $retrieve_url = Url::fromRoute('commerce_pos.parked_order_retrieve', ['commerce_order' => $order->id()]);

      /* @var \Drupal\commerce_order\Entity\Order $order */
      // The link to the order.
      $order_url = Url::fromRoute('entity.commerce_order.canonical', ['commerce_order' => $order->id()], [
        'attributes' => [
          'target' => '_blank',
        ],
      ]);

      $cashier = User::load($order->get('field_cashier')->getValue()[0]['target_id']);

      $cashier_url = Url::fromRoute('entity.user.canonical', [
        'user' => $cashier->id(),
      ], [
        'attributes' => [
          'target' => '_blank',
        ],
      ]);

      $customer_url = Url::fromRoute('entity.user.canonical', [
        'user' => $order->getCustomer()
          ->id(),
      ], [
        'attributes' => [
          'target' => '_blank',
        ],
      ]);

      // Form the customer link and email.
      $customer = [
        '#type' => 'inline_template',
        '#template' => '{{ user_link }} <br \> {{ user_email }}',
        '#context' => [
          'user_link' => Link::fromTextAndUrl($order->getCustomer()->getDisplayName(), $customer_url),
          'user_email' => $order->getCustomer()->getEmail(),
        ],
      ];

      // Format the total price of the order.
      $store = $order->getStore();
      $default_currency = $store->getDefaultCurrency();
      $total_price = $order->getTotalPrice();
      if (!empty($total_price)) {
        $formatted_amount = $currency_formatter->format($total_price->getNumber(), $total_price->getCurrencyCode());
      }
      else {
        $formatted_amount = $currency_formatter->format("0", $default_currency->getCurrencyCode());
      }

      // Add each row to the rows array.
      $rows[] = [
        Link::fromTextAndUrl($order->id(), $order_url),
        DrupalDateTime::createFromTimestamp($order->getChangedTime())->format('Y-m-d H:i'),
        $order->getState()->getLabel(),
        Link::fromTextAndUrl($cashier->getDisplayName(), $cashier_url),
        ['data' => $customer],
        $order->getEmail(),
        $formatted_amount,
        Link::fromTextAndUrl('Retrieve', $retrieve_url),
      ];
    }

    $output = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
    $output['pager'] = [
      '#type' => 'pager',
    ];

    return \Drupal::service('renderer')->render($output);
  }

  /**
   * Ajax callback for the order lookup submit button.
   */
  public function orderLookupAjaxRefresh(array $form, FormStateInterface &$form_state) {
    $search_text = $form_state->getValue('search_box');

    $results = $this->searchOrderResults($form_state, $search_text, 'parked', '=');

    $response = new AjaxResponse();
    $response->addCommand(new HtmlCommand('#order-lookup-results', $results));

    return $response;
  }

}
