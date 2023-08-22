<?php

declare(strict_types=1);

namespace UserManager\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Uri;
use League\Tactician\CommandBus;
use Mezzio\Session\SessionInterface;
use Mezzio\Session\LazySession;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UserManager\Auth\LoginCommand;
use UserManager\Form\Login;

use function in_array;

class LoginHandler implements MiddlewareInterface
{
    private const REDIRECT_ATTRIBUTE = 'authentication:redirect';
    public function __construct(
        private CommandBus $commandBus,
        private TemplateRendererInterface $template,
        private Login $form
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var LazySession */
        $session  = $request->getAttribute('session');
        $redirect = $this->getRedirect($request, $session);
        // Handle submitted credentials
        if ('POST' === $request->getMethod()) {
            if ($this->commandBus->handle(new LoginCommand($request, $session))) {
                return new RedirectResponse($redirect);
            } else {
                return new HtmlResponse($this->template->render(
                    'user-manager::login',
                    ['form' => $this->form] // parameters to pass to template
                ));
            }
        }
        // Display initial login form
        $session->set(self::REDIRECT_ATTRIBUTE, $redirect);
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->template->render(
            'user-manager::login',
            ['form' => $this->form] // parameters to pass to template
        ));
    }

    private function getRedirect(
        ServerRequestInterface $request,
        SessionInterface $session
    ): string {
        /** @var string */
        $redirect = $session->get(self::REDIRECT_ATTRIBUTE);

        if (! $redirect) {
            $uri = new Uri($request->getHeaderLine('Referer'));
            $redirect = $uri->getPath();
            if (in_array($redirect, ['', '/user/login'], true)) {
                $redirect = '/';
            }
        }

        return $redirect;
    }
}
