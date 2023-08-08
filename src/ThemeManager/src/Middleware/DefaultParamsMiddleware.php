<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use Mezzio\Authentication\UserInterface;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Helper\UrlHelper;
use Mezzio\Router\RouteResult;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DefaultParamsMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
        private UrlHelper $urlHelper
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'currentUser',
            $request->getAttribute(UserInterface::class)
        );

        $routeResult      = $this->urlHelper->getRouteResult();
        $matchedRouteName = $routeResult->getMatchedRouteName();
        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'matchedRouteName',
            $matchedRouteName ?? null
        );

        if ($routeResult->isSuccess()) {
            $this->template->addDefaultParam(
                TemplateRendererInterface::TEMPLATE_ALL,
                'url',
                $this->urlHelper->generate(
                    $matchedRouteName,
                    $routeResult->getMatchedParams(),
                    $request->getQueryParams()
                )
            );
        }

        $flashMessages = $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE);
        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'systemMessages',
            $flashMessages ? $flashMessages->getFlashes() : []
        );

        return $handler->handle($request);
    }
}
