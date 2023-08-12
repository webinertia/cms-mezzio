<?php

declare(strict_types=1);

namespace PageManager\Handler;

use DebugBar\DebugBar;
use League\Tactician\CommandBus;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;

class PageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $router = $container->get(RouterInterface::class);
        assert($router instanceof RouterInterface);

        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        assert($template instanceof TemplateRendererInterface || null === $template);

        //$debug = $container->get(DebugBar::class);

        return new PageHandler(
            $container->get(CommandBus::class),
            $template,
            //$debug
        );
    }
}
