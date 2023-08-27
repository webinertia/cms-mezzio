<?php

declare(strict_types=1);

namespace PageManagerTest\Storage;

use PageManager\Storage\SavePageCommandHandler;
use PageManager\Storage\SavePageCommandHandlerFactory as Factory;
use Test\AbtractIntegrationTestCase;

final class SavePageCommandHandlerFactoryTest extends AbtractIntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testFactory(): void
    {
        $factory = new Factory();
        $service = $factory($this->container);
        self::assertInstanceOf(SavePageCommandHandler::class, $service);
    }
}
