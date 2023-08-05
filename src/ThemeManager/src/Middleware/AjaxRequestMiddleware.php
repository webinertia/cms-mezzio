<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AjaxRequestMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        if (! $request->hasHeader('X-Requested-With')) {
            // if we do not have this bail early
            return $handler->handle($request);
        }

        if (in_array('XMLHttpRequest', $request->getHeader('X-Requested-With'), true)) {
            $this->template->addDefaultParam(
                TemplateRendererInterface::TEMPLATE_ALL,
                'layout',
                false
            );
        }

        return $handler->handle($request);
    }
}
