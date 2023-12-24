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
   *
   * Adding the Dependency Injection(DI) as a Container into Controller
   * using create method in D10 as per the community guidelines
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

    // Adding this for rendering the form programatically without writing all the business logic
    // & want to use pre-existing form in the site
    // $builder = \Drupal::formBuilder();
    // $form = $builder->getForm('Drupal\hello_world\Form\SalutationConfigurationForm');
  }


}
