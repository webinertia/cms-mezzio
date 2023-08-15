<?php

declare(strict_types=1);

namespace Log;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class MonologMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : MonologMiddleware
    {
        return new MonologMiddleware($container->get(LoggerInterface::class));
    }
}
