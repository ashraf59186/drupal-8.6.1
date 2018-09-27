<?php

namespace Drupal\ashraf_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class RouteController.
 */
class RouteController extends ControllerBase {

  /**
   * Helloworld.
   *
   * @return string
   *   Return Hello string.
   */
  public function helloWorld() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: helloWorld')
    ];
  }

}
