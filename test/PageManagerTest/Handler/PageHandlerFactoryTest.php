<?php

/**
 * Test Type: Unit
 */

declare(strict_types=1);

namespace PageManagerTest\Handler;

use PageManager\Handler\PageHandler;
use PageManager\Handler\PageHandlerFactory;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

final class PageHandlerFactoryTest extends TestCase
{
        /** @var ContainerInterface&MockObject */
        protected $container;

        /** @var RouterInterface&MockObject */
        protected $router;

        protected function setUp(): void
        {
            $this->container = $this->createMock(ContainerInterface::class);
            $this->router    = $this->createMock(RouterInterface::class);
        }

        public function testFactoryWithTemplate(): void
        {
            $renderer = $this->createMock(TemplateRendererInterface::class);
            $this->container
                ->expects($this->once())
                ->method('has')
                ->with(TemplateRendererInterface::class)
                ->willReturn(true);
            $this->container
                ->expects($this->once())
                ->method('get')
                ->with(
                    TemplateRendererInterface::class
                )
                ->willReturn(
                    $renderer
                );

            $factory  = new PageHandlerFactory();
            $homePage = $factory($this->container);

            self::assertInstanceOf(PageHandler::class, $homePage);
        }
}
