<?php declare(strict_types=1);

namespace Drupal\fruition_logging;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;

class CustomConsoleLoggingServiceProvider extends ServiceProviderBase {

  public function alter(ContainerBuilder $container) {
    // Override the defaults from Monolog module to log everything to console.
    $container->setParameter('monolog.channel_handlers', [
      'default' => ['console'],
    ]);
  }

}
