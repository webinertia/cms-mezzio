<?php

declare(strict_types=1);

namespace UserManager\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Tactician\CommandBus;
use Mezzio\Session\LazySession;
use Mezzio\Session\SessionMiddleware;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UserManager\Auth\LogoutCommand;

class LogoutHandler implements RequestHandlerInterface
{
    public function __construct(
        private CommandBus $commandBus,
        private TemplateRendererInterface $renderer
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var LazySession */
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        try {
            $this->commandBus->handle(new LogoutCommand($session));
            return new RedirectResponse('/');
        } catch (\Throwable $th) {
            //throw $th;
        }
        // maybe render on logout failure???
        return new HtmlResponse($this->renderer->render(
            'user-manager::logout',
            [] // parameters to pass to template
        ));
    }
}
