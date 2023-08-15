<?php

declare(strict_types=1);

namespace UserManager\Auth;

use App\CommandBus\AbstractCommand;
use Mezzio\Authentication\UserInterface;
use Mezzio\Session\SessionInterface;

final readonly class LogoutCommand extends AbstractCommand
{
    public function __construct(
        public SessionInterface $session,
        public ?UserInterface $userInterface = null
    ) {
    }
}
