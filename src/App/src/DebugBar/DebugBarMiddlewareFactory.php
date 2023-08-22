<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\DebugBar;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class DebugBarMiddlewareFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @return DebugBarMiddleware
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): DebugBarMiddleware
    {
        /** @var DebugBar */
        $debugbar = $container->get(DebugBar::class);
        return new DebugBarMiddleware($debugbar);
    }
}
