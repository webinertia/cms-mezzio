<?php

declare(strict_types=1);

namespace UserManager\Auth;

use App\CommandBus\AbstractCommand;
use Mezzio\Session\SessionInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class LoginCommand extends AbstractCommand
{
    public function __construct(
        public ServerRequestInterface $request,
        public SessionInterface $session
    ) {
    }
}
