<?php

declare(strict_types=1);

namespace App;

use League\Tactician\CommandEvents\EventMiddleware;
use League\Tactician\Plugins\NamedCommand\NamedCommandExtractor;
use Mezzio\Application;
use Mezzio\Container\ApplicationConfigInjectionDelegator;
use TacticianModule\Locator\ClassnameLaminasLocator;

/**
 * The configuration provider for the App module
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
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'routes'       => $this->getRoutes(),
            'tactician'    => $this->getTacticianConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [
                    ApplicationConfigInjectionDelegator::class,
                ],
            ],
            'factories' => [
                EventMiddleware::class => CommandBus\EventMiddlewareFactory::class,
            ],
            'invokables' => [
                Handler\PingHandler::class     => Handler\PingHandler::class,
                NamedCommandExtractor::class   => NamedCommandExtractor::class,
                ClassnameLaminasLocator::class => ClassnameLaminasLocator::class,
            ],
        ];
    }

    public function getTacticianConfig(): array
    {
        return [
            'default-extractor'  => NamedCommandExtractor::class,
            'middleware' => [
                EventMiddleware::class => 50,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }

    public function getRoutes(): array
    {
        return [
            [
                'path'            => '/api/ping',
                'name'            => 'api.ping',
                'middleware'      => Handler\PingHandler::class,
                'allowed_methods' => ['GET'],
            ],
        ];
    }
}
