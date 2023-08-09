<?php

declare(strict_types=1);

namespace PageManager\Storage;

use Psr\Container\ContainerInterface;

final class SaveCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container): SaveCommandHandler
    {
        return new SaveCommandHandler(
            $container->get(PageRepository::class)
        );
    }
}
