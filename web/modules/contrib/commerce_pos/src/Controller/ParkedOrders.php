<?php

namespace Drupal\commerce_pos\Controller;

use Drupal\commerce_order\Entity\Order;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Builds the parked order listing page.
 */
class ParkedOrders extends ControllerBase {

  /**
   * Retrieves a parked order.
   *
   * @param \Drupal\commerce_order\Entity\Order $commerce_order
   *   The parked order to retrieve.
   */
  public function parkedOrderRetrieve(Order $commerce_order) {
    if ($commerce_order->getState()->value !== 'parked') {
      throw new AccessDeniedHttpException('Only parked orders can be retrieved');
    }
    $commerce_order->set('state', 'draft');
    $commerce_order->save();

    $pos_url = Url::fromRoute('commerce_pos.main', ['commerce_order' => $commerce_order->id()]);

    $response = new RedirectResponse($pos_url->toString());
    return $response->send();
  }

}
