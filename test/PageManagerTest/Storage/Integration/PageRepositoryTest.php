<?php

declare(strict_types=1);

namespace PageManagerTest\Storage\Integration;

use PageManager\Storage\PageEntity;
use PageManager\Storage\PageRepository;
use Test\Integration\AbstractTestCase;

final class PageRepositoryTest extends AbstractTestCase
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
