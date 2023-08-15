<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use DebugBar\DebugBar;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function in_array;
use function str_contains;

class AjaxRequestMiddleware implements MiddlewareInterface
{
    public const HTML_CONTENT_TYPE = 'text/html';
    public function __construct(
        private TemplateRendererInterface $template,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (! $request->hasHeader('X-Requested-With')) {
            // if we do not have this bail early
            return $handler->handle($request->withAttribute('isAjax', false));
        }

        if (in_array('XMLHttpRequest', $request->getHeader('X-Requested-With'), true)) {
            // for ajax do not render the layout again
            $this->template->addDefaultParam(
                TemplateRendererInterface::TEMPLATE_ALL,
                'layout',
                false
            );
        }

        return $handler->handle($request->withAttribute('isAjax', true));
    }
}
