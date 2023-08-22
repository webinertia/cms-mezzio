<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\DataCollector\ConfigCollector;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class ConfigCollectorFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @return ConfigCollector
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): ConfigCollector
    {
        /** @var array<array-key, mixed> */
        $config = $container->get('config');
        return new ConfigCollector($config);
    }
}
