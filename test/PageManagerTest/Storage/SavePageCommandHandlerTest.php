<?php

/**
 * Test Type: Integration
 */

declare(strict_types=1);

namespace PageManagerTest\Storage;

use League\Tactician\CommandBus;
use PageManager\Storage\PageEntity;
use PageManager\Storage\SavePageCommand;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

final class SavePageCommandHandlerTest extends TestCase
{
    /** @var ContainerInterface&MockObject */
    protected $container;

    /** @var CommandBus */
    protected $commandBus;

    /** @var array<string, int|string|null> $data */
    protected $data = [
        'title'       => 'SavePageCommandHandlertest',
        'description' => 'Created during test.',
    ];

    protected function setUp(): void
    {
        $this->initContainer();
    }

    protected function initContainer(): void
    {
        $this->container = require __DIR__ . '/../../../config/container.php';
    }

    public function testSavePageCommandHandlerHandlesCommand(): void
    {
        $commandBus = $this->container->get(CommandBus::class);
        $entity     = new PageEntity(...$this->data);
        $command    = new SavePageCommand($entity);
        $result     = $commandBus->handle($command);
        $this->assertInstanceOf(PageEntity::class, $result);
    }
}
