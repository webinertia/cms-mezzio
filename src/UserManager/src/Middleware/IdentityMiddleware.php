<?php

declare(strict_types=1);

namespace UserManager\Middleware;

use Mezzio\Authentication\UserInterface;
use Mezzio\Session\LazySession;
use Mezzio\Session\SessionMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class IdentityMiddleware implements MiddlewareInterface
{
    /** @var callable $factory */
    private $factory;
    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var LazySession */
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if (! $session->has(UserInterface::class)) {
            return $handler->handle(
                $request->withAttribute(
                    UserInterface::class,
                    ($this->factory)('guest', ['Guest'], []) // then call the factory to create a guest
                )
            );
        }
        /** @var array<string, string[]> */
        $user = $session->get(UserInterface::class);
        return $handler->handle(
            $request->withAttribute(
                UserInterface::class,
                ($this->factory)($user['username'], $user['roles'], $user['details'])
            )
        );
    }
}
