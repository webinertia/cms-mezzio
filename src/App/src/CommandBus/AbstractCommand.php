<?php

declare(strict_types=1);

namespace App\CommandBus;

abstract readonly class AbstractCommand implements CommandInterface
{
    private iterable $args;

    public function getCommandName()
    {
        return static::class;
    }
}
