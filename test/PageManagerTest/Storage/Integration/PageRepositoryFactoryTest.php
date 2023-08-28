<?php

declare(strict_types=1);

namespace PageManagerTest\Storage\Integration;

use PageManager\Storage\PageRepository;
use PageManager\Storage\PageRepositoryFactory;
use Test\Integration\AbstractTestCase;

final class PageRepositoryFactoryTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testFactory(): void
    {
        $factory = new PageRepositoryFactory();
        $repo    = $factory($this->container);
        self::assertInstanceOf(PageRepository::class, $repo);
    }
}
