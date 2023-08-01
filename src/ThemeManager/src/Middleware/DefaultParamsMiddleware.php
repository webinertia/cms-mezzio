<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Mezzio\Router\RouteResult;
use Mezzio\Authentication\UserInterface;
use Mezzio\Flash\FlashMessagesInterface;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Helper\ServerUrlHelper;

class DefaultParamsMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
        private ServerUrlHelper $uri
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        //$session = $request->getAttribute('session');

        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'currentUser',
            $request->getAttribute(UserInterface::class)
        );
        $routeResult = $request->getAttribute(RouteResult::class);
        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'matchedRouteName',
            $routeResult ? $routeResult->getMatchedRouteName() : null
        );
        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'currentUri',
            $this->uri->generate()
        );
        $flashMessages = $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE);
        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'systemMessages',
            $flashMessages ? $flashMessages->getFlashes() : []
        );
        return $handler->handle($request);
    }
}
