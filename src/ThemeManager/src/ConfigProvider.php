<?php

declare(strict_types=1);

namespace ThemeManager;

use Mezzio\LaminasView\LaminasViewRenderer;
use Tuupola\Middleware\ServerTimingMiddleware;

/**
 * The configuration provider for the ThemeManager module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            //'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                ServerTimingMiddleware::class,
            ],
            // 'aliases' => [
            //     LaminasViewRenderer::class => Renderer::class,
            // ],
            'factories'  => [
                LaminasViewRenderer::class => RendererFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'theme-manager'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
