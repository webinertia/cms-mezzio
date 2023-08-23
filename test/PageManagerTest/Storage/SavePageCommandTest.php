<?php

declare(strict_types=1);

namespace PageManagerTest\Storage;

use PageManager\Storage\PageEntity;
use PageManager\Storage\SavePageCommand;
use PHPUnit\Framework\TestCase;

final class SavePageCommandTest extends TestCase
{
    public function testSavePageCommandAcceptsPageEntityAsArgument(): void
    {
        $command = new SavePageCommand(
            new PageEntity()
        );
        $this->assertInstanceOf(PageEntity::class, $command->entity);
    }
}
