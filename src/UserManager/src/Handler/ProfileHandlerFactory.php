<?php

declare(strict_types=1);

namespace UserManager\Handler;

use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProfileHandlerFactory
{
    public function __invoke(ContainerInterface $container): ProfileHandler
    {
        /** @var LaminasViewRenderer */
        $renderer = $container->get(TemplateRendererInterface::class);
        return new ProfileHandler($renderer);
    }
}
