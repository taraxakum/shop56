<?php

namespace Drupal\commerce_pos\Plugin\Field\FieldWidget;

use Drupal\commerce_order\Entity\OrderItem;
use Drupal\commerce_price\Price;
use Drupal\commerce_product\Entity\ProductVariation;
use Drupal\Component\Utility\Html;
use Drupal\Core\Config\Config;
use Drupal\Core\Entity\EntityDisplayRepositoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Plugin implementation of the 'pos_order_item_widget' widget.
 *
 * @FieldWidget(
 *   id = "pos_order_item_widget",
 *   label = @Translation("Pos order item widget"),
 *   field_types = {
 *     "entity_reference"
 *   },
 *   multiple_values = true
 * )
 */
class PosOrderItemWidget extends WidgetBase implements WidgetInterface, ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The entity display repository.
   *
   * @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface
   */
  protected $entityDisplayRepository;

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Configuration for commerce_pos.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $posConfig;

  /**
   * Constructs a EntityReferenceEntityFormatter instance.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param array $third_party_settings
   *   Any third party settings settings.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityDisplayRepositoryInterface $entity_display_repository
   *   The entity display repository.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\Core\Config\Config $pos_config
   *   Configuration for commerce_pos.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings, EntityTypeManagerInterface $entity_type_manager, EntityDisplayRepositoryInterface $entity_display_repository, MessengerInterface $messenger, Config $pos_config) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);

    $this->entityTypeManager = $entity_type_manager;
    $this->entityDisplayRepository = $entity_display_repository;
    $this->messenger = $messenger;
    $this->posConfig = $pos_config;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['third_party_settings'],
      $container->get('entity_type.manager'),
      $container->get('entity_display.repository'),
      $container->get('messenger'),
      $container->get('config.factory')->get('commerce_pos.settings')
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'size' => 60,
      'placeholder' => 'Scan or enter product name or SKU',
      'num_results' => 10,
      'purchasable_entity_view_mode' => 'commerce_pos_product_select',
      'allow_decimal' => TRUE,
      'decimal_step' => '0.1',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['size'] = [
      '#type' => 'number',
      '#title' => $this->t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    ];
    $elements['placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => $this->t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];
    $elements['num_results'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of search results'),
      '#default_value' => $this->getSetting('num_results'),
      '#required' => TRUE,
      '#min' => 1,
      '#max' => 50,
    ];
    $elements['purchasable_entity_view_mode'] = [
      '#type' => 'select',
      '#title' => $this->t('Purchasable entity view mode'),
      '#default_value' => $this->getSetting('purchasable_entity_view_mode'),
      '#required' => TRUE,
      // @todo use the "Purchasable entity type" from the order item type.
      '#options' => $this->entityDisplayRepository->getViewModeOptions('commerce_product_variation'),
      '#description' => $this->t('This view mode is used for the list of product variations to select from.'),
    ];
    $elements['allow_decimal'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow decimal quantities'),
      '#default_value' => $this->getSetting('allow_decimal'),
    ];
    $elements['decimal_step'] = [
      '#type' => 'select',
      '#title' => $this->t('Step'),
      '#description' => $this->t('Only quantities that are multiples of the selected step will be allowed.'),
      '#default_value' => $this->getSetting('decimal_step'),
      '#options' => [
        '0.1' => '0.1',
        '0.01' => '0.01',
        '0.25' => '0.25',
        '0.5' => '0.5',
        '0.05' => '0.05',
      ],
      '#states' => [
        'visible' => [
          ':input[name="fields[order_items][settings_edit_form][settings][allow_decimal]"]' => ['checked' => TRUE],
        ],
      ],
      '#required' => TRUE,
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = $this->t('Textfield size: @size', ['@size' => $this->getSetting('size')]);
    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = $this->t('Placeholder: @placeholder', ['@placeholder' => $this->getSetting('placeholder')]);
    }

    $summary[] = $this->t('Number of results: @num_results', ['@num_results' => $this->getSetting('num_results')]);
    $summary[] = $this->t('Purchasable entity view mode: @view_mode', ['@view_mode' => $this->getSetting('purchasable_entity_view_mode')]);
    $summary[] = $this->t('Allow decimal quantities: @allow_decimal', ['@allow_decimal' => $this->getSetting('allow_decimal') ? 'Yes' : 'No']);
    if ($this->getSetting('allow_decimal')) {
      $summary[] = $this->t('Quantity step: @decimal_step', ['@decimal_step' => $this->getSetting('decimal_step')]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function extractFormValues(FieldItemListInterface $items, array $form, FormStateInterface $form_state) {
    // There's nothing to do here the order already has the references. They
    // have been added by static::addOrderItem().
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // Determine which step we're in.
    $this->is_edit_order = $form_state->get('is_edit_order');
    // Determine the initial items on the order.
    $this->initial_items_on_order = $form_state->get('initial_items_on_order');
    // Set the order_has_return_item flag to FALSE initially. We might need
    // this flag in the future to structure the form differently.
    $form_state->set('order_has_return_items', FALSE);

    if ($form_state->getTriggeringElement()) {
      $this->processFormSubmission($items, $form, $form_state);
    }
    $element = [
      '#type' => 'fieldset',
      '#tree' => TRUE,
      '#description' => $this->fieldDefinition->getDescription(),
      '#field_title' => $this->fieldDefinition->getLabel(),
    ] + $element;

    // Make a wrapper for the entire form.
    // @todo this feels off. There must be a better way.
    if (empty($form_state->wrapper_id)) {
      $wrapper_id = Html::getUniqueId(__CLASS__);
      $form['#prefix'] = '<div id="' . $wrapper_id . '">';
      $form['#suffix'] = '</div>';
    }
    else {
      $wrapper_id = $form_state->wrapper_id;
    }

    $element['product_selector'] = [
      '#type' => 'textfield',
      '#size' => $this->getSetting('size'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => $this->getFieldSetting('max_length'),
      '#default_value' => NULL,
      '#autocomplete_route_name' => 'commerce_pos.pos_order_item_widget_autocomplete',
      '#autocomplete_route_parameters' => [
        // @todo use the "Purchasable entity type" from the order type.
        'entity_type' => 'commerce_product_variation',
        'view_mode' => $this->getSetting('purchasable_entity_view_mode'),
        'count' => $this->getSetting('num_results'),
      ],
      '#ajax' => [
        'event' => 'autocompleteclose',
        'callback' => [$this, 'ajaxRefresh'],
        'wrapper' => $wrapper_id,
      ],
    ];

    $index = $this->posConfig->get('product_search_index');
    if (!$index) {
      $configuration_link = Link::createFromRoute('POS Settings', 'commerce_pos.settings')->toRenderable();
      $search_index_configuration = Link::createFromRoute('search index', 'search_api.overview')->toRenderable();
      $this->messenger->addError($this->t('You can not search until a @search_index is configured in the @configuration.', ['@configuration' => render($configuration_link), '@search_index' => render($search_index_configuration)]));
      $element['product_selector']['#disabled'] = TRUE;
    }

    // Render a list of products that have been added to the order.
    $referenced_entities = $items->referencedEntities();
    $element['order_items'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Product'),
        $this->t('Unit price'),
        $this->t('Quantity'),
        $this->t('Action'),
        $this->t('Return'),
      ],
    ];

    /** @var \Drupal\commerce_order\Entity\OrderItem $entity */
    foreach ($referenced_entities as $entity) {
      $item_form = $this->orderItemForm($entity, $wrapper_id);
      array_unshift($element['order_items'], $item_form);

      // Save in the form_state that we have a return item on this order, if the
      // order item is a 'return' type.
      if ($entity->type->getValue()[0]['target_id'] == 'return') {
        $form_state->set('order_has_return_items', TRUE);
      }
    }

    $element['#default_value'] = $items->referencedEntities();
    return ['target_id' => $element];
  }

  /**
   * Creates a form for an order item.
   *
   * @param \Drupal\commerce_order\Entity\OrderItem $order_item
   *   The prder item.
   * @param string $wrapper_id
   *   The wrapper ID to use for Ajax.
   *
   * @return array
   *   The oprder item form.
   */
  protected function orderItemForm(OrderItem $order_item, $wrapper_id) {
    $user = \Drupal::currentUser();
    $product = $order_item->getPurchasedEntity();

    // Determine if the quantity field should accept decimals.
    if ($this->getSetting('allow_decimal')) {
      $this->getSetting('decimal_step');
      // If decimals are allowed, get the step and precision values.
      $step = $this->getSetting('decimal_step');

      $quantity = $order_item->getQuantity();
    }
    else {
      $step = 1;
      $quantity = round($order_item->getQuantity(), 0);
    }

    // If we don't render product here the title appears in the wrong place.
    // @todo work out why and fix this.
    $view_builder = $this->entityTypeManager->getViewBuilder($order_item->getEntityTypeId());
    $product_render = $view_builder->view($product, $this->getSetting('purchasable_entity_view_mode'), $order_item->language()
      ->getId());
    $currency_formatter = \Drupal::service('commerce_price.currency_formatter');
    $unit_price = $order_item->getUnitPrice();

    $form = [
      'purchasable_entity' => [
        '#type' => 'markup',
        '#markup' => \Drupal::service('renderer')->render($product_render),
      ],
      'unit_price' => [
        'unit_price' => [
          '#type' => 'commerce_price',
          '#title' => $this->t('Unit price'),
          '#title_display' => 'invisible',
          '#name' => 'update_unit_price_' . $product->id(),
          '#default_value' => $unit_price->toArray(),
          '#allow_negative' => TRUE,
          '#order_item_id' => $order_item->id(),
          '#disabled' => !$user->hasPermission('alter product unit price') ? TRUE : FALSE,
          '#ajax' => [
            'callback' => [$this, 'ajaxRefresh'],
            'wrapper' => $wrapper_id,
            'event' => 'change',
            'progress' => [
              'message' => '',
            ],
          ],
        ],
        'unit_price_hidden' => [
          '#type' => 'hidden',
          '#value' => $currency_formatter->format($unit_price->getNumber(), $unit_price->getCurrencyCode()),
          '#attributes' => [
            'class' => 'commerce-pos-customer-display-unit-price-hidden',
          ],
        ],
        'item_total_price_hidden' => [
          '#type' => 'hidden',
          '#value' => $currency_formatter->format($order_item->getTotalPrice()->getNumber(), $order_item->getTotalPrice()->getCurrencyCode()),
          '#attributes' => [
            'class' => 'commerce-pos-customer-display-item-total-price-hidden',
          ],
        ],
      ],
      'quantity' => [
        'quantity' => [
          '#title' => $this->t('Quantity'),
          '#title_display' => 'invisible',
          '#type' => 'number',
          '#step' => $step,
          '#size' => 4,
          '#min' => 0,
          '#default_value' => $quantity,
          '#attributes' => [
            'class' => [
              'commerce-pos-order-item-quantity',
            ],
          ],
          '#ajax' => [
            'callback' => [$this, 'ajaxRefresh'],
            'wrapper' => $wrapper_id,
            'event' => 'change',
            'progress' => [
              'message' => '',
            ],
          ],
          '#order_item_id' => $order_item->id(),
        ],
        'quantity_hidden' => [
          '#type' => 'hidden',
          '#value' => $quantity,
        ],
      ],
      'remove_order_item' => [
        '#type' => 'button',
        '#name' => 'remove_order_item_' . $order_item->id(),
        '#value' => $this->t('Remove'),
        '#ajax' => [
          'callback' => [$this, 'ajaxRefresh'],
          'wrapper' => $wrapper_id,
          'progress' => [
            'message' => '',
          ],
        ],
        '#order_item_id' => $order_item->id(),
        '#limit_validation_errors' => [],
      ],
    ];

    // If we're adding a new order item, add a checkbox to toggle the item
    // as a return item, if it's not already a return item.
    $initial_items_on_order = $this->initial_items_on_order;
    $order_item_newly_added = !isset($initial_items_on_order[$order_item->id()]) ? TRUE : FALSE;
    $is_return_for_order_item = $order_item->getData('return_for_order_item');

    if (!$is_return_for_order_item && $order_item_newly_added) {
      $form['set_order_item_as_return'] = [
        '#type' => 'checkbox',
        '#name' => 'set_order_item_as_return_' . $order_item->id(),
        '#title' => $this->t('Set as return item'),
        '#ajax' => [
          'callback' => [$this, 'ajaxRefresh'],
          'wrapper' => $wrapper_id,
          'progress' => [
            'message' => '',
          ],
        ],
        '#order_item_id' => $order_item->id(),
        '#default_value' => $order_item->type->getValue()[0]['target_id'] == 'return' ? TRUE : FALSE,
        '#limit_validation_errors' => [],
      ];
    }
    // If we're editing an order, add a 'return' button next to
    // each item.
    elseif ($this->is_edit_order && $order_item->type->getValue()[0]['target_id'] != 'return') {
      $form['return_order_item'] = [
        '#type' => 'button',
        '#name' => 'return_order_item_' . $order_item->id(),
        '#value' => $this->t('Return'),
        '#ajax' => [
          'callback' => [$this, 'ajaxRefresh'],
          'wrapper' => $wrapper_id,
          'progress' => [
            'message' => '',
          ],
        ],
        '#order_item_id' => $order_item->id(),
        '#limit_validation_errors' => [],
      ];
    }
    // Else, we just add an empty row so the rows don't look ugly when the
    // return buttons are missing.
    else {
      $form['empty_row'] = [
        '#type' => 'item',
        '#markup' => '',
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function errorElement(array $element, ConstraintViolationInterface $error, array $form, FormStateInterface $form_state) {
    return isset($element['target_id']) ? $element['target_id'] : FALSE;
  }

  /**
   * Process any user input before building the widget.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Values for this field.
   * @param array $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  protected function processFormSubmission(FieldItemListInterface $items, array &$form, FormStateInterface $form_state) {
    $trigger_element = $form_state->getTriggeringElement();

    $order = FALSE;
    if ($trigger_element['#name'] === 'order_items[target_id][product_selector]') {
      $order = $this->addOrderItem($items, $form, $form_state);
    }
    elseif (strpos($trigger_element['#name'], 'remove_order_item_') === 0) {
      $order = $this->removeOrderItem($items, $form, $form_state);
    }
    elseif (strpos($trigger_element['#name'], 'return_order_item_') === 0) {
      $order = $this->returnOrderItem($items, $form, $form_state);
    }
    elseif (strpos($trigger_element['#name'], 'set_order_item_as_return_') === 0) {
      $order = $this->toggleOrderItemAsReturn($items, $form, $form_state);
    }
    elseif (preg_match('/^order_items\[target_id\]\[order_items\]\[([0-9])*\]\[unit_price\]\[unit_price\]\[number\]$/', $trigger_element['#name'])) {
      $order = $this->updateUnitPrice($items, $form, $form_state);
    }
    elseif (preg_match('/^order_items\[target_id\]\[order_items\]\[([0-9])*\]\[quantity\]\[quantity\]$/', $trigger_element['#name'])) {
      $order = $this->updateQuantity($items, $form, $form_state);
    }
    if ($order) {
      // Update the draft order with the changes.
      $order->recalculateTotalPrice()->save();
      // Update the order on the form.
      $form_object = $form_state->getFormObject();
      $form_object->setEntity($order);

      // Remove the user input as we no longer need it.
      $user_input = $form_state->getUserInput();
      unset($user_input['order_items']);
      $form_state->setUserInput($user_input);
    }
  }

  /**
   * Updates an order item quantity from form field.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Values for this field.
   * @param array $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return \Drupal\commerce_order\Entity\Order
   *   The updated commerce order.
   */
  protected function updateQuantity(FieldItemListInterface $items, array &$form, FormStateInterface &$form_state) {
    $trigger_element = $form_state->getTriggeringElement();
    $order_item = OrderItem::load($trigger_element['#order_item_id']);
    $value_key = $trigger_element['#parents'];
    $new_quantity = $form_state->getValue($value_key);
    if (!$this->getSetting('allow_decimal')) {
      $new_quantity = round($new_quantity, 0);
    }
    /** @var \Drupal\commerce_order\Entity\Order $order */
    $order = $form_state->getFormObject()->getEntity();
    if ($new_quantity > 0) {
      $order_item->setQuantity($new_quantity);
      $order_item->save();
    }
    else {
      $order->removeItem($order_item);
      $order_item->delete();
    }
    return $order;
  }

  /**
   * Updates an order item quantity from form field.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Values for this field.
   * @param array $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return \Drupal\commerce_order\Entity\Order
   *   The updated commerce order.
   */
  protected function removeOrderItem(FieldItemListInterface $items, array &$form, FormStateInterface &$form_state) {
    $trigger_element = $form_state->getTriggeringElement();
    $order_item = OrderItem::load($trigger_element['#order_item_id']);

    /** @var \Drupal\commerce_order\Entity\Order $order */
    $order = $form_state->getFormObject()->getEntity();
    $order->removeItem($order_item);
    $order_item->delete();
    return $order;
  }

  /**
   * Creates a return order item.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Values for this field.
   * @param array $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return \Drupal\commerce_order\Entity\Order
   *   The updated commerce order.
   */
  protected function returnOrderItem(FieldItemListInterface $items, array &$form, FormStateInterface &$form_state) {
    $trigger_element = $form_state->getTriggeringElement();

    /** @var \Drupal\commerce_order\Entity\OrderItem $new_order_item */
    $order_item = OrderItem::load($trigger_element['#order_item_id']);

    /** @var \Drupal\commerce_order\Entity\Order $order */
    $order = $form_state->getFormObject()->getEntity();

    // Loading the product variation object.
    $product_variation = ProductVariation::load($order_item->getPurchasedEntityId());

    // If we've not loaded a product variation then exit doing nothing.
    if (!$product_variation) {
      // There's nothing to do.
      return FALSE;
    }

    // Create new order Item for adding into existing order.
    $new_order_item = OrderItem::create([
      'type' => 'return',
      'title' => $product_variation->label(),
      'purchased_entity' => $product_variation,
      'quantity' => 1,
      'data' => [
        'return_for_order_item' => $order_item->id(),
      ],
    ]);
    $price = new Price('-' . $product_variation->get('price')->number, $order_item->getUnitPrice()->getCurrencyCode());
    $new_order_item->setUnitPrice($price, TRUE)->save();

    // Add the new item into the order.
    $order->addItem($new_order_item);
    return $order;
  }

  /**
   * Toggles an order item as a return item.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Values for this field.
   * @param array $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return \Drupal\commerce_order\Entity\Order
   *   The updated commerce order.
   */
  protected function toggleOrderItemAsReturn(FieldItemListInterface $items, array &$form, FormStateInterface &$form_state) {
    $trigger_element = $form_state->getTriggeringElement();

    /** @var \Drupal\commerce_order\Entity\OrderItem $new_order_item */
    $order_item = OrderItem::load($trigger_element['#order_item_id']);

    /** @var \Drupal\commerce_order\Entity\Order $order */
    $order = $form_state->getFormObject()->getEntity();

    // Toggles the order item as a return item and change the unit price to a
    // negative price.
    // If it is already a return item, set it as a default order item.
    if ($order_item->type->getValue()[0]['target_id'] == 'return') {
      $new_price = abs($order_item->getUnitPrice()->getNumber());
      $order_item->set('type', 'default');
      $order_item->setUnitPrice(new Price("$new_price", $order_item->getUnitPrice()
        ->getCurrencyCode()), TRUE)->save();
    }
    // Else, we set the order item as a return item.
    else {
      $order_item->set('type', 'return');
      $order_item->setUnitPrice(new Price('-' . $order_item->getUnitPrice()
        ->getNumber(), $order_item->getUnitPrice()->getCurrencyCode()), TRUE)
        ->save();
    }
    return $order;
  }

  /**
   * Updates the unit price for an order item.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Values for this field.
   * @param array $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return \Drupal\commerce_order\Entity\Order
   *   The updated commerce order.
   */
  protected function updateUnitPrice(FieldItemListInterface $items, array &$form, FormStateInterface &$form_state) {
    $trigger_element = $form_state->getTriggeringElement();
    $value_key = $trigger_element['#parents'];
    array_pop($value_key);
    $value = $form_state->getValue($value_key);
    // Get the order id from the parent.
    $order_item = OrderItem::load($items->get($value_key[3])
      ->getValue()['target_id']);
    /** @var \Drupal\commerce_order\Entity\Order $order */
    $order = $form_state->getFormObject()->getEntity();

    $order_item_id = $form_state->getCompleteForm()['order_items']['widget']['target_id']['order_items'][$value_key[3]]['unit_price']['unit_price']['#order_item_id'];

    $order_item = OrderItem::load($order_item_id);

    $order_item
      ->setUnitPrice(new Price($value['number'], $value['currency_code']), TRUE)
      ->save();

    return $order;
  }

  /**
   * Adds an order item from the autocomplete test field to the order.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   *   Values for this field.
   * @param array $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return \Drupal\commerce_order\Entity\Order|false
   *   The updated commerce order if it has been updated, or FALSE if not.
   */
  protected function addOrderItem(FieldItemListInterface $items, array &$form, FormStateInterface &$form_state) {
    // Loading the product variation object.
    $product_variation = ProductVariation::load($form_state->getValue([
      'order_items',
      'target_id',
      'product_selector',
    ]));

    if (!$product_variation) {
      $variation = \Drupal::entityQuery('commerce_product_variation')
        ->condition('field_upc', $form_state->getValue([
          'order_items', 'target_id', 'product_selector',
        ]))
        ->range(0, 1)
        ->execute();

      if ($variation) {
        $product_variation = ProductVariation::load(reset($variation));
      }
    }

    // If we've not loaded a product variation then exit doing nothing.
    if (!$product_variation) {
      // There's nothing to do.
      return FALSE;
    }

    // If there is already an order item for this variation add to the quantity.
    $create_new_order_item = TRUE;
    $order = $form_state->getFormObject()->getEntity();
    /** @var \Drupal\commerce_order\Entity\OrderItem $order_item */
    foreach ($order->getItems() as $order_item) {
      if ($order_item->getPurchasedEntity()
        ->id() === $product_variation->id() && $order_item->type->getValue()[0]['target_id'] == 'default'
      ) {
        $create_new_order_item = FALSE;
        $order_item
          ->setQuantity($order_item->getQuantity() + 1)
          ->save();
        break;
      }
    }
    if ($create_new_order_item) {
      // Create new order Item for adding into existing order.
      $order_item = OrderItem::create([
        'type' => 'default',
        'title' => $product_variation->label(),
        'purchased_entity' => $product_variation,
        'quantity' => 1,
        'unit_price' => $product_variation->getPrice(),
      ]);
      $order_item->save();

      // Adding the item into the Order.
      $order->addItem($order_item);
    }

    return $order;
  }

  /**
   * Ajax callback.
   */
  public static function ajaxRefresh(&$form, FormStateInterface $form_state) {
    // Anything on the form might have changed because we're updating the order.
    return $form;
  }

}
