<?php

declare(strict_types=1);

namespace PageManagerTest\Storage;

use PageManager\Storage\PageEntity;
use PageManager\Storage\PageRepository;
use Test\AbtractIntegrationTestCase;

final class PageRepositoryTest extends AbtractIntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testSaveInsertReturnsEntity(): void
    {
        $entity = new PageEntity(null, static::class, 'testSaveReturnsEntity()');
        /** @var PageRepository */
        $repo   = $this->container->get(PageRepository::class);
        /** @var PageEntity */
        $result = $repo->save($entity);

        $id     = $result->getId();
        self::assertEquals($entity->getId(), $id);
    }
}
