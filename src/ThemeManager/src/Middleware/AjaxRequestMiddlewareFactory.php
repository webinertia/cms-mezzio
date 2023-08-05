<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AjaxRequestMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : AjaxRequestMiddleware
    {
        return new AjaxRequestMiddleware($container->get(TemplateRendererInterface::class));
    }
}
