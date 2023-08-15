<?php

declare(strict_types=1);

namespace UserManager\Handler;

use League\Tactician\CommandBus;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LogoutHandlerFactory
{
    public function __invoke(ContainerInterface $container): LogoutHandler
    {
        return new LogoutHandler(
            $container->get(CommandBus::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
