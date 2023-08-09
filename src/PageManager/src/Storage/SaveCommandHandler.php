<?php

declare(strict_types=1);

namespace PageManager\Storage;

use App\Tactician\CommandHandlerInterface;
use App\Tactician\CommandInterface;
use Webinertia\Db\EntityInterface;

final class SaveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private PageRepository $storage
    ) {
    }

    public function execute(CommandInterface $command)
    {
        return $this->storage->save($command->entity);
    }
}
