<?php

/**
 * Test Type: Integration
 * todo: needs mocked componets as this test is kinda dirty
 */

declare(strict_types=1);

namespace PageManagerTest\Storage;

use League\Tactician\CommandBus;
use PageManager\Storage\PageEntity;
use PageManager\Storage\SavePageCommand;
use Test\AbtractIntegrationTestCase;

final class SavePageCommandHandlerTest extends AbtractIntegrationTestCase
{
    /** @var CommandBus */
    protected $commandBus;

    /** @var array<string, int|string|null> $data */
    protected $data = [
        'title'       => 'SavePageCommandHandlertest',
        'description' => 'Created during test.',
    ];

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testSavePageCommandHandlerHandlesCommand(): void
    {
        /** @var CommandBus */
        $commandBus = $this->container->get(CommandBus::class);
        /** @psalm-suppress PossiblyInvalidArgument */
        $entity     = new PageEntity(...$this->data);
        $command    = new SavePageCommand($entity);
        $result     = $commandBus->handle($command);
        $this->assertInstanceOf(PageEntity::class, $result);
    }
}
