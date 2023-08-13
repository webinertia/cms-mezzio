<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\Bridge\MonologCollector;
use DebugBar\StandardDebugBar;
use Psr\Container\ContainerInterface;

final class StandardDebugBarDelegatorFactory
{
    public function __invoke(ContainerInterface $container, $name, callable $callback): StandardDebugBar
    {
        $debugBar = $callback();
        $collector = $container->get(MonologCollector::class);
        $debugBar->addCollector($collector);
        return $debugBar;
    }
}
