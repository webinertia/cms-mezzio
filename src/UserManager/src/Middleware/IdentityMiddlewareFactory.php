<?php

declare(strict_types=1);

namespace UserManager\Middleware;

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Psr\Container\ContainerInterface;
use UserManager\Authentication\CurrentUserFactory;

class IdentityMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : IdentityMiddleware
    {
        return new IdentityMiddleware(
            $container->get(UserInterface::class)
        );
    }
}
