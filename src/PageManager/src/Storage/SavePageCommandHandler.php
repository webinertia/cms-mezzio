<?php

declare(strict_types=1);

namespace PageManager\Storage;

use App\CommandBus\CommandInterface;

final class SavePageCommandHandler
{
    public function __construct(
        private PageRepository $storage
    ) {
    }

    public function handle(CommandInterface $command)
    {
        return $this->storage->save($command->entity);
    }
}
