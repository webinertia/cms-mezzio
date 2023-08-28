<?php

declare(strict_types=1);

namespace PageManagerTest\Storage\Integration;

use League\Tactician\CommandBus;
use PageManager\Storage\PageEntity;
use PageManager\Storage\SavePageCommand;
use Test\Integration\AbstractTestCase;

final class SavePageCommandHandlerTest extends AbstractTestCase
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
