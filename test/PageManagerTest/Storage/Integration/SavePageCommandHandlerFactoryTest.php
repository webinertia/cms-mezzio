<?php

declare(strict_types=1);

namespace PageManagerTest\Storage\Integration;

use PageManager\Storage\SavePageCommandHandler;
use PageManager\Storage\SavePageCommandHandlerFactory as Factory;
use Test\Integration\AbstractTestCase;

final class SavePageCommandHandlerFactoryTest extends AbstractTestCase
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
