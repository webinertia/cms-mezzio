<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\DataCollector\ConfigCollector;
use Psr\Container\ContainerInterface;

final class ConfigCollectorFactory
{
    public function __invoke(ContainerInterface $container): ConfigCollector
    {
        return new ConfigCollector($container->get('config'));
    }
}
