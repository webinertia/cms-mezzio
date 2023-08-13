<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\Bridge\MonologCollector;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class MonologCollectorFactory
{
    public function __invoke(ContainerInterface $container): MonologCollector
    {
        return new MonologCollector($container->get(LoggerInterface::class));
    }
}
