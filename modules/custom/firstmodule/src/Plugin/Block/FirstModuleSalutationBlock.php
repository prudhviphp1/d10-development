<?php

namespace Drupal\firstmodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\firstmodule\FirstModuleSalutation;

/**
 * First Module Salutation block.
 *
 * @Block(
 *  id = "first_module_salutation_block",
 *  admin_label = @Translation("First Module salutation"),
 * )
 * Adding the PluginAnnotations as there are the Discovery mechanisms used in Drupal to recognise
 * the plugins in Drupal UI & these will be replaced by PHP Attributes in Drupal11 as per the Drupal community talk.
 */
class FirstModuleSalutationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The salutation service.
   *
   * @var \Drupal\firstmodule\FirstModuleSalutation
   */
  protected $salutation;

  /**
   * Constructs a FirstModuleSalutationBlock.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, HelloWorldSalutation $salutation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('firstmodule.salutation')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

}
