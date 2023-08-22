<?php

declare(strict_types=1);

namespace UserManager\Handler;

use Laminas\Form\FormElementManager;
use Laminas\ServiceManager\ServiceManager;
use League\Tactician\CommandBus;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use UserManager\Form\Login;
use Webmozart\Assert\Assert;

class LoginHandlerFactory
{
    /**
     *
     * @param ServiceManager $container
     * @return LoginHandler
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): LoginHandler
    {
        /** @var CommandBus */
        $commandBus = $container->get(CommandBus::class);
        /** @var LaminasViewRenderer */
        $renderer    = $container->get(TemplateRendererInterface::class);
        /** @var FormElementManager */
        $formManager = $container->get(FormElementManager::class);
        /** @var Login */
        $form = $formManager->get(Login::class);
        return new LoginHandler(
            $commandBus,
            $renderer,
            $form
        );
    }
}
