<?php

declare(strict_types=1);

namespace UserManager\Auth;

use App\CommandBus\CommandInterface;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;

final class LoginCommandHandler
{
    public function __construct(
        private AuthenticationInterface $auth
    ) {
    }

    public function handle(LoginCommand $command): ?UserInterface
    {
        // User session takes precedence over user/pass POST in
        // the auth adapter so we remove the session prior
        // to auth attempt
        $command->session->unset(UserInterface::class);
        return $this->auth->authenticate($command->request);
    }
}
