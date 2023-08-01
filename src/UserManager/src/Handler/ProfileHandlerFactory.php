<?php

declare(strict_types=1);

namespace UserManager\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProfileHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProfileHandler
    {
        return new ProfileHandler($container->get(TemplateRendererInterface::class));
    }
}
