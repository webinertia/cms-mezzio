<?php

declare(strict_types=1);

namespace PageManager\Storage;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator\ReflectionHydrator;
use Psr\Container\ContainerInterface;
use Webinertia\Db\TableGateway;

final class PageRepositoryFactory
{
    public function __invoke(ContainerInterface $container): PageRepository
    {
        /** @var Adapter */
        $adapter = $container->get(AdapterInterface::class);
        return new PageRepository(
            new TableGateway(
                'page',
                $adapter,
                null,
                new HydratingResultSet(
                    new ReflectionHydrator(),
                    new PageEntity()
                )
            ),
            new ReflectionHydrator(),
        );
    }
}
