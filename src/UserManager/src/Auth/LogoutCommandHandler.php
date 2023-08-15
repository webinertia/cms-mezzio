<?php

declare(strict_types=1);

namespace UserManager\Auth;

use App\CommandBus\CommandInterface;
use Mezzio\Authentication\UserInterface;

final class LogoutCommandHandler
{
    public function handle(CommandInterface $command)
    {
        $command->session->clear();
        $command->session->regenerate();
        if ($command->session->has(UserInterface::class)) {
            // throw exception
        }
    }
}
