<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\DebugBar;
use Psr\Container\ContainerInterface;

final class DebugBarMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): DebugBarMiddleware
    {
        return new DebugBarMiddleware($container->get(DebugBar::class));
    }
}
