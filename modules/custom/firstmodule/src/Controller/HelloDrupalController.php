<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;


class HelloDrupalController extends ControllerBase {

  /**
   * Defining the Controller method for the '/hello' path custom route
   */
  public function helloDrupal(){

    /**
     * Hello Drupal
     *
     * @return array
     * Our Custom Message
     */
    return[
      '#markup' => $this->t('Hello Drupal Custom Route'),
    ];
  }


}
