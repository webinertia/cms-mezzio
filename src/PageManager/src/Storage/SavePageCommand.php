<?php

declare(strict_types=1);

namespace PageManager\Storage;

use App\CommandBus\AbstractCommand;

final readonly class SavePageCommand extends AbstractCommand
{
    public function __construct(
        public PageEntity $entity,
    ) {
    }
}
