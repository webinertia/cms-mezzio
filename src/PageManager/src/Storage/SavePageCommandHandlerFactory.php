<?php

declare(strict_types=1);

namespace PageManager\Storage;

use Psr\Container\ContainerInterface;

final class SavePageCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container): SavePageCommandHandler
    {
        return new SavePageCommandHandler(
            $container->get(PageRepository::class)
        );
    }
}
