<?php

declare(strict_types=1);

namespace PageManager\Storage;

use Webinertia\Db\EntityInterface;

final class SavePageCommandHandler
{
    public function __construct(
        private PageRepository $storage
    ) {
    }

    public function handle(SavePageCommand $command): EntityInterface|int
    {
        return $this->storage->save($command->entity);
    }
}
