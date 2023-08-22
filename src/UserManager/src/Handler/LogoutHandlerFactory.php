<?php

declare(strict_types=1);

namespace UserManager\Handler;

use League\Tactician\CommandBus;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LogoutHandlerFactory
{
    public function __invoke(ContainerInterface $container): LogoutHandler
    {
        /** @var CommandBus */
        $commandBus = $container->get(CommandBus::class);
        /** @var LaminasViewRenderer */
        $renderer = $container->get(TemplateRendererInterface::class);
        return new LogoutHandler(
            $commandBus,
            $renderer
        );
    }
}
