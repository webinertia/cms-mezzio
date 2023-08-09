<?php

declare(strict_types=1);

namespace PageManager\Storage;

use App\Tactician\CommandHandlerInterface;
use App\Tactician\CommandInterface;
use Webinertia\Db\EntityInterface;

final class SaveCommandHandler
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
