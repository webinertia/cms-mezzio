<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class AjaxRequestMiddlewareFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @return AjaxRequestMiddleware
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AjaxRequestMiddleware
    {
        /** @var LaminasViewRenderer */
        $renderer = $container->get(TemplateRendererInterface::class);
        return new AjaxRequestMiddleware($renderer);
    }
}
