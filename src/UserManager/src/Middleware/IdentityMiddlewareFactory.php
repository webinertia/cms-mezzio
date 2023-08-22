<?php

declare(strict_types=1);

namespace UserManager\Middleware;

use Mezzio\Authentication\UserInterface;
use Psr\Container\ContainerInterface;

class IdentityMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): IdentityMiddleware
    {
        /** @var callable */
        $factory = $container->get(UserInterface::class);
        return new IdentityMiddleware(
            $factory
        );
    }
}
