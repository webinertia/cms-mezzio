<?php

declare(strict_types=1);

namespace PageManagerTest\Storage;

use Laminas\Db\Adapter\AdapterInterface;
use PageManager\Storage\PageRepository;
use PageManager\Storage\PageRepositoryFactory;
use Test\AbtractIntegrationTestCase;

final class PageRepositoryFactoryTest extends AbtractIntegrationTestCase
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
