<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class DefaultParamsMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : DefaultParamsMiddleware
    {
        return new DefaultParamsMiddleware(
            $container->get(TemplateRendererInterface::class),
            $container->get(ServerUrlHelper::class)
        );
    }
}
