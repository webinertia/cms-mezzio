<?php

declare(strict_types=1);

namespace App\Tactician;

use League\Tactician\Handler\MethodNameInflector\MethodNameInflector;

final class ExecuteInflector implements MethodNameInflector
{
    public function inflect($command, $commandHandler)
    {
        return 'execute';
    }
}
