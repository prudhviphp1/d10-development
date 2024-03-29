<?php

namespace Drupal\firstmodule;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * Prepares the salutation in the website.
 */
class FirstModuleSalutation {

  use StringTranslationTrait;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The event dispatcher.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * FirstModuleSalutation constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Symfony\Contracts\EventDispatcher\EventDispatcherInterface $eventDispatcher
   *   The event dispatcher.
   */
  public function __construct(ConfigFactoryInterface $config_factory, EventDispatcherInterface $eventDispatcher) {
    $this->configFactory = $config_factory;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * Returns the salutation.
   *
   * @return string
   *   The salutation message.
   */
  public function getSalutation() {
    $config = $this->configFactory->get('firstmodule.custom_salutation');
    $salutation = $config->get('salutation');
    // Checking whether the salutation is not empty & it exists
    if ($salutation !== "" && $salutation) {
    // $event is having dependency on SalutationEvent
      $event = new SalutationEvent();
      $event->setValue($salutation);
      $event = $this->eventDispatcher->dispatch($event, SalutationEvent::EVENT);
      return $event->getValue();
    }

    //Adding the logic to display the greeting based upon the time of the day

    //Used the native PHP time() function to get the current time, and that’s OK.
    //But you should know that Drupal has its very own Drupal\Component\Datetime\Time
    //service that we can use to get the current time. It also has additional methods for requesting
    //time-specific information, so make sure to check it out and use it when appropriate.
    $time = new \DateTime();
    if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
      return $this->t('Good morning world');
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      return $this->t('Good afternoon world');
    }

    if ((int) $time->format('G') >= 18) {
      return $this->t('Good evening world');
    }
  }

   /**
    * Returns the Salutation using the render array.
    *
    * Creating a new method for altering the Salutation based on the overridden feature rather
    * than changing the existing method
    */
   public function getSalutationComponent() {
     $render = [
       '#theme' => 'firstmodule_salutation',
     ];

     $config = $this->configFactory->get('firstmodule.custom_salutation');
     $salutation = $config->get('salutation');

     if ($salutation !== "" && $salutation) {
       $event = new SalutationEvent();
       $event->setValue($salutation);
       $this->eventDispatcher->dispatch($event, SalutationEvent::EVENT);
       $render['#salutation'] = $event->getValue();
       $render['#overridden'] = TRUE;
       return $render;
     }

     $time = new \DateTime();
     $render['#target'] = $this->t('world');

     if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
       $render['#salutation'] = $this->t('Good morning');
       return $render;
     }

     if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
       $render['#salutation'] = $this->t('Good afternoon');
       return $render;
     }

     if ((int) $time->format('G') >= 18) {
       $render['#salutation'] = $this->t('Good evening');
       return $render;
     }
   }


}
