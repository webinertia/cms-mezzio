<?php

declare(strict_types=1);

namespace Log;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;
use Psr\Container\ContainerInterface;

final class RepositoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): RepositoryHandler
    {
        return new RepositoryHandler(
            new TableGateway(
                $container->get('config')['log']['table'],
                $container->get(AdapterInterface::class)
            )
        );
    }
}
