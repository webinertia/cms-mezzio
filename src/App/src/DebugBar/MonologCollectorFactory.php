<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\Bridge\MonologCollector;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class MonologCollectorFactory
{
    public function __invoke(ContainerInterface $container): MonologCollector
    {
        /** @var Logger */
        $logger = $container->get(LoggerInterface::class);
        return new MonologCollector($logger);
    }
}
