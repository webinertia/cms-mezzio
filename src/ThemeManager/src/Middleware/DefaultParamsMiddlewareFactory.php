<?php

declare(strict_types=1);

namespace ThemeManager\Middleware;

use Mezzio\Helper\UrlHelper;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class DefaultParamsMiddlewareFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @return DefaultParamsMiddleware
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): DefaultParamsMiddleware
    {
        /** @var LaminasViewRenderer */
        $renderer = $container->get(TemplateRendererInterface::class);
        /** @var UrlHelper */
        $helper = $container->get(UrlHelper::class);
        return new DefaultParamsMiddleware(
            $renderer,
            $helper
        );
    }
}
