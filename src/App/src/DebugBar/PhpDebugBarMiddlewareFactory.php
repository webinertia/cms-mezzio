<?php
declare (strict_types=1);

namespace App\DebugBar;

use DebugBar\JavascriptRenderer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class PhpDebugBarMiddlewareFactory
{
    /**
     *
     * @param ContainerInterface $container
     * @return PhpDebugBarMiddleware
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): PhpDebugBarMiddleware
    {
        /** @var JavascriptRenderer */
        $renderer = $container->get(JavascriptRenderer::class);
        /** @var ResponseFactoryInterface */
        $responseFactory = $container->get(ResponseFactoryInterface::class);
        /** @var StreamFactoryInterface */
        $streamFactory = $container->get(StreamFactoryInterface::class);

        return new PhpDebugBarMiddleware($renderer, $responseFactory, $streamFactory);
    }
}
