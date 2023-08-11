<?php

declare(strict_types=1);

namespace App\CommandBus;

use League\Tactician\Plugins\NamedCommand\NamedCommand;

interface CommandInterface extends NamedCommand
{
    //public function args(iterable $args): void;
}
