<?php

declare(strict_types=1);

namespace ThemeManager;

use Mezzio\LaminasView\LaminasViewRenderer;

/**
 * The configuration provider for the ThemeManager module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'middleware_pipeline' => $this->getPipeConfig(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                LaminasViewRenderer::class                => RendererFactory::class,
                Middleware\AjaxRequestMiddleware::class   => Middleware\AjaxRequestMiddlewareFactory::class,
                Middleware\DefaultParamsMiddleware::class => Middleware\DefaultParamsMiddlewareFactory::class,
            ],
        ];
    }

    public function getPipeConfig(): array
    {
        return [
            Middleware\AjaxRequestMiddleware::class => [
                'middleware' => [
                    Middleware\AjaxRequestMiddleware::class
                ],
                'priority' => 4,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'theme-manager' => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
