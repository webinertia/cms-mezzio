<?php

declare(strict_types=1);

namespace UserManager\Auth;

use Mezzio\Authentication\AuthenticationInterface;
use Psr\Container\ContainerInterface;

final class LoginCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container): LoginCommandHandler
    {
        return new LoginCommandHandler($container->get(AuthenticationInterface::class));
    }
}
