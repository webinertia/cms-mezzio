<?php

declare(strict_types=1);

namespace UserManager\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse; // add this line
use Laminas\Diactoros\Uri;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UserManager\Form\Login;
use Mezzio\Session\SessionInterface;

class LoginHandler implements MiddlewareInterface
{
    private const REDIRECT_ATTRIBUTE = 'authentication:redirect';
    public function __construct(
        private TemplateRendererInterface $template,
        private AuthenticationInterface $auth,
        private Login $form
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $session  = $request->getAttribute('session');
        $redirect = $this->getRedirect($request, $session);

        // Handle submitted credentials
        if ('POST' === $request->getMethod()) {
            return $this->handleLoginAttempt($request, $session, $redirect);
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

    private function handleLoginAttempt(
        ServerRequestInterface $request,
        SessionInterface $session,
        string $redirect
    ) : ResponseInterface {
        // User session takes precedence over user/pass POST in
        // the auth adapter so we remove the session prior
        // to auth attempt
        $session->unset(UserInterface::class);

        // Login was successful
        if ($this->auth->authenticate($request)) {
            $session->unset(self::REDIRECT_ATTRIBUTE);
            return new RedirectResponse($redirect);
        }

        // Login failed
        return new HtmlResponse($this->template->render(
            'user-manager::login',
            ['form' => $this->form] // parameters to pass to template
        ));
    }

    private function getRedirect(
        ServerRequestInterface $request,
        SessionInterface $session
    ) : string {
        $redirect = $session->get(self::REDIRECT_ATTRIBUTE);

        if (! $redirect) {
            $redirect = (new Uri($request->getHeaderLine('Referer')))->getPath();
            if (in_array($redirect, ['', '/user/login'], true)) {
                $redirect = '/';
            }
        }

        return $redirect;
    }
}