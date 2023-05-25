<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\firstmodule\FirstModuleSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;


class HelloDrupalController extends ControllerBase {

  /**
   * The salutation service.
   * Adding the custom Salutation service here
   *
   * @var \Drupal\firstmodule\FirstModuleSalutation
   */
  protected $salutation;

  /**
   * HelloDrupalController constructor.
   *
   * @param \Drupal\firstmodule\FirstModuleSalutation $salutation
   *   The salutation service.
   *
   * Injecting the custom salutation service into Controller by adding it to the construct
   */
  public function __construct(FirstModuleSalutation $salutation) {
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('firstmodule.salutation')
    );
  }
  /**
   * Defining the Controller method for the '/hello' path custom route.
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
