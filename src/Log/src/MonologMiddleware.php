<?php

declare(strict_types=1);

namespace Log;

use Mezzio\Authentication\UserInterface;
use Monolog\Logger;
use Monolog\LogRecord;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use UserManager\Auth\CurrentUser;

class MonologMiddleware implements MiddlewareInterface
{
    public function __construct(
        private LoggerInterface|Logger $logger
    ) {
    }

    /**
     * @psalm-suppress all
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        /** @var CurrentUser */
        $userInterface = $request->getAttribute(UserInterface::class);
        $this->logger->pushProcessor(function (LogRecord $record) use ($userInterface) {
            /** @var non-empty-string */
            $record['extra']['userName'] = $userInterface->getIdentity();
            return $record;
        });
        return $handler->handle($request);
    }
}
