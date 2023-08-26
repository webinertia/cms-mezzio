<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

abstract class AbtractIntegrationTestCase extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp(): void
    {
        parent::setUp();
        $this->initContainer();
    }

    protected function initContainer(): void
    {
        $this->container = require __DIR__ . '/../../config/container.php';
    }
}
