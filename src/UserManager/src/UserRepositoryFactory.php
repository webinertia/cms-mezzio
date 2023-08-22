<?php

declare(strict_types=1);

namespace UserManager;

use Laminas\Db\Adapter\AdapterInterface;
use Mezzio\Authentication\UserRepositoryInterface;
use Psr\Container\ContainerInterface;
use Webinertia\Db\TableGateway;

final class UserRepositoryFactory
{

    public function __invoke(ContainerInterface $container): UserRepositoryInterface
    {
        /** @psalm-suppress MixedArgument, MixedArrayAccess */
        return new UserRepository(
            new TableGateway(
                'user',
                $container->get(AdapterInterface::class)
            ),
            $container->get('config')['authentication']
        );
    }
}
