<?php

declare(strict_types=1);

namespace Log;

use Psr\Log\LoggerInterface;

/**
 * The configuration provider for the Log module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    public const TABLE_NAME = 'log';
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
            'log'   => $this->getRepositoryConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Processor\RamseyUuidProcessor::class => Processor\RamseyUuidProcessor::class,
            ],
            'factories'  => [
                LoggerInterface::class   => LogFactory::class,
                RepositoryHandler::class => RepositoryHandlerFactory::class,
            ],
        ];
    }

    public function getRepositoryConfig(): array
    {
        return [
            'table' => self::TABLE_NAME,
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'log'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
