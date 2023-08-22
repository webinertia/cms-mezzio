<?php

declare(strict_types=1);

namespace Log;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class RepositoryHandlerFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @return RepositoryHandler
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RepositoryHandler
    {
        /** @var array{log: array{table: string}} */
        $config = $container->get('config');
        /** @var Adapter */
        $adapter = $container->get(AdapterInterface::class);

        //$table = $config['log']['table'];
        return new RepositoryHandler(
            new TableGateway(
                $config['log']['table'],
                $adapter
            )
        );
    }
}
