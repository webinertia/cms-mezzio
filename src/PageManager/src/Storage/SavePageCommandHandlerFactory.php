<?php

declare(strict_types=1);

namespace PageManager\Storage;

use Psr\Container\ContainerInterface;

final class SavePageCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container): SavePageCommandHandler
    {
        /** @var PageRepository */
        $repo = $container->get(PageRepository::class);
        return new SavePageCommandHandler(
            $repo
        );
    }
}
