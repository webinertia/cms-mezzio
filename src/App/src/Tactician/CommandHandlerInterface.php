<?php

declare(strict_types=1);

namespace App\Tactician;

/**
 * Could possibly extend the ACL resource interfaces
 * would need to decide on naming convention for resources and privileges
 * @package App\Tactician
 */
interface CommandHandlerInterface
{
    public function execute(CommandInterface $command);
}
