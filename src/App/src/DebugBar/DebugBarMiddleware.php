<?php

declare(strict_types=1);

namespace App\DebugBar;

use DebugBar\DebugBar;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DebugBarMiddleware implements MiddlewareInterface
{
    public function __construct(private DebugBar $debugBar)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        return $handler->handle(
            $request->withAttribute(
                DebugBar::class,
                $this->debugBar
            )
        );
    }
}
