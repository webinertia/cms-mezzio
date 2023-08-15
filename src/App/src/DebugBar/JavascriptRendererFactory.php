<?php
declare (strict_types=1);

namespace App\DebugBar;

use DebugBar\DebugBar;
use DebugBar\JavascriptRenderer;
use Psr\Container\ContainerInterface;

final class JavascriptRendererFactory
{
    public function __invoke(ContainerInterface $container): JavascriptRenderer
    {
        $debugBar = $container->get(DebugBar::class);
        $config   = $container->get('config');
        $rendererOptions = $config['phpmiddleware']['phpdebugbar']['javascript_renderer'];

        $renderer = new JavascriptRenderer($debugBar);
        $renderer->setOptions($rendererOptions);

        return $renderer;
    }
}
