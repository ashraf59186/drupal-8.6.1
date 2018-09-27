<?php

namespace Drupal\ashraf_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class DefaultController.
 */
class DefaultController extends ControllerBase {

  /**
   * Hellodynamic.
   *
   * @return string
   *   Return Hello string.
   */
  public function helloDynamic($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: helloDynamic with parameter(s): $name'),
    ];
  }

}
