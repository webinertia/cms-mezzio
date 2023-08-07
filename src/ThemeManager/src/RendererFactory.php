<?php

declare(strict_types=1);

namespace ThemeManager;

use Laminas\View\HelperPluginManager;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\Resolver;
use Mezzio\Helper\ServerUrlHelper as BaseServerUrlHelper;
use Mezzio\Helper\UrlHelper as BaseUrlHelper;
use Mezzio\LaminasView\Exception;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\LaminasView\ServerUrlHelper;
use Mezzio\LaminasView\UrlHelper;
use Psr\Container\ContainerInterface;

use function dirname;
use function is_array;
use function is_dir;
use function is_numeric;
use function realpath;
use function sprintf;

final class RendererFactory
{
    public function __invoke(ContainerInterface $container): LaminasViewRenderer
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $themes = isset($config['theme_manager']['themes']) && is_array($config['theme_manager']['themes'])
            ? $config['theme_manager']['themes'] : [];

        $config = $config['templates'] ?? [];

        // Configuration
        $resolver = new Resolver\AggregateResolver();
        $resolver->attach(
            new Resolver\TemplateMapResolver($config['map'] ?? []),
            100
        );

        // Create or retrieve the renderer from the container
        $renderer = $container->has(PhpRenderer::class)
            ? $container->get(PhpRenderer::class)
            : ($container->has('Zend\View\Renderer\PhpRenderer')
                ? $container->get('Zend\View\Renderer\PhpRenderer')
                : new PhpRenderer());
        $renderer->setResolver($resolver);

        // Inject helpers
        $this->injectHelpers($renderer, $container);

        $defaultSuffix = $config['extension'] ?? $config['default_suffix'] ?? null;
        // Inject renderer
        $view = new LaminasViewRenderer($renderer, $config['layout'] ?? null, $defaultSuffix);

        // Add template paths
        $allPaths = isset($config['paths']) && is_array($config['paths']) ? $config['paths'] : [];
        foreach ($allPaths as $namespace => $paths) {
            $namespace = is_numeric($namespace) ? null : $namespace;
            foreach ((array) $paths as $path) {
                $basePath = realpath(dirname($path));
                foreach ($themes as $theme) {
                    if (
                        $theme['name'] === 'default'
                        && $theme['active']
                    ) {
                        $view->addPath($basePath . '/' . $theme['name'] . '/' . $namespace, $namespace);
                    } elseif ($theme['name'] !== 'default' && $theme['active']) {
                        $view->addPath($basePath . '/default/' . $namespace);
                        $themePath = $basePath . '/' . $theme['name'] . '/' . $namespace;
                        if (is_dir($themePath)) {
                            $view->addPath($basePath . '/' . $theme['name'] . '/' . $namespace);
                        }
                    }
                }
            }
        }

        return $view;
    }

    /**
     * Inject helpers into the PhpRenderer instance.
     *
     * If a HelperPluginManager instance is present in the container, uses that;
     * otherwise, instantiates one.
     *
     * In each case, injects with the custom url/serverurl implementations.
     *
     * @throws Exception\MissingHelperException
     */
    private function injectHelpers(PhpRenderer $renderer, ContainerInterface $container): void
    {
        $helpers = $this->retrieveHelperManager($container);
        $helpers->setAlias('url', BaseUrlHelper::class);
        $helpers->setAlias('Url', BaseUrlHelper::class);
        $helpers->setFactory(BaseUrlHelper::class, static function () use ($container): UrlHelper {
            if (
                ! $container->has(BaseUrlHelper::class)
                && ! $container->has('Zend\Expressive\Helper\UrlHelper')
            ) {
                throw new Exception\MissingHelperException(sprintf(
                    'An instance of %s is required in order to create the "url" view helper; not found',
                    BaseUrlHelper::class
                ));
            }
            return new UrlHelper(
                $container->has(BaseUrlHelper::class)
                    ? $container->get(BaseUrlHelper::class)
                    : $container->get('Zend\Expressive\Helper\UrlHelper')
            );
        });

        $helpers->setAlias('serverurl', BaseServerUrlHelper::class);
        $helpers->setAlias('serverUrl', BaseServerUrlHelper::class);
        $helpers->setAlias('ServerUrl', BaseServerUrlHelper::class);
        $helpers->setFactory(BaseServerUrlHelper::class, static function () use ($container): ServerUrlHelper {
            if (
                ! $container->has(BaseServerUrlHelper::class)
                && ! $container->has('Zend\Expressive\Helper\ServerUrlHelper')
            ) {
                throw new Exception\MissingHelperException(sprintf(
                    'An instance of %s is required in order to create the "url" view helper; not found',
                    BaseServerUrlHelper::class
                ));
            }
            return new ServerUrlHelper(
                $container->has(BaseServerUrlHelper::class)
                    ? $container->get(BaseServerUrlHelper::class)
                    : $container->get('Zend\Expressive\Helper\ServerUrlHelper')
            );
        });

        $renderer->setHelperPluginManager($helpers);
    }

    private function retrieveHelperManager(ContainerInterface $container): HelperPluginManager
    {
        if ($container->has(HelperPluginManager::class)) {
            return $container->get(HelperPluginManager::class);
        }

        if ($container->has('Zend\View\HelperPluginManager')) {
            return $container->get('Zend\View\HelperPluginManager');
        }

        return new HelperPluginManager($container);
    }
}
