<?php

declare(strict_types=1);

namespace Log;

use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

class MonologMiddlewareFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @return MonologMiddleware
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : MonologMiddleware
    {
        /** @var Logger */
        $logger = $container->get(LoggerInterface::class);
        return new MonologMiddleware($logger);
    }
}
