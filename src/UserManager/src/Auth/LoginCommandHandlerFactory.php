<?php

declare(strict_types=1);

namespace UserManager\Auth;

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\Session\PhpSession;
use Psr\Container\ContainerInterface;

final class LoginCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container): LoginCommandHandler
    {
        /** @var PhpSession */
        $authInterface = $container->get(AuthenticationInterface::class);
        return new LoginCommandHandler($authInterface);
    }
}
