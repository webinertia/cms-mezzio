<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\Bridge\MonologCollector;
use DebugBar\DebugBarException;
use DebugBar\StandardDebugBar;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class StandardDebugBarDelegatorFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @param class-string $name
     * @param callable $callback
     * @return StandardDebugBar
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws DebugBarException
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback): StandardDebugBar
    {
        /** @var StandardDebugBar */
        $debugBar = $callback();
        /** @var MonologCollector */
        $collector = $container->get(MonologCollector::class);
        $debugBar->addCollector($collector);
        return $debugBar;
    }
}
