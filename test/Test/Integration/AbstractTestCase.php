<?php

declare(strict_types=1);

namespace Test\Integration;

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

abstract class AbstractTestCase extends TestCase
{
    /** @var Application $app */
    protected $app;
    /** @var ContainerInterface */
    protected $container;

    protected function setUp(): void
    {
        parent::setUp();
        $this->initContainer();
        // $this->initApp();
        // $this->initPipeline();
    }

    protected function initContainer(): void
    {
        $this->container = require __DIR__ . '/../../../config/container.php';
    }

    protected function initApp(): void
    {
        /** @var Application */
        $this->app = $this->container->get(Application::class);
    }

    protected function initPipeline(): void
    {
        /** @var MiddlewareFactory */
        $factory = $this->container->get(MiddlewareFactory::class);
        (require __DIR__ . '/../../../config/pipeline.php')($this->app, $factory, $this->container);
    }
}
