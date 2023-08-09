<?php

declare(strict_types=1);

namespace PageManager\Storage;

use App\Tactician\CommandInterface;

final class SaveCommand implements CommandInterface
{
    public function __construct(
        public PageEntity $entity
    ) {
    }
}
