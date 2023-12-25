<?php

namespace Drupal\firstmodule;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Overrides the core configuration in the FirstModule custom module.
 */
class FirstModuleConfigOverrides implements ConfigFactoryOverrideInterface {

  /**
   * {@inheritdoc}
   *
   * Returns config overrides.
   */
  public function loadOverrides($names) {
    $overrides = [];
    if (in_array('system.maintenance', $names)) {
      $overrides['system.maintenance'] = ['message' => 'Our own message for the site maintenance mode.'];
    }

    return $overrides;
  }

  /**
   * {@inheritdoc}
   *
   *  Defining the string to append to the configuration static cache name.
   */
  public function getCacheSuffix() {
    return 'FirstModuleConfigOverrider';
  }

  /**
   * {@inheritdoc}
   *
   * Creates a configuration object for use during install and synchronization.
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

  /**
   * {@inheritdoc}
   *
   * Gets the cacheability metadata associated with the config factory override.
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

}
