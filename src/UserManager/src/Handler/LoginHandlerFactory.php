<?php

declare(strict_types=1);

namespace UserManager\Handler;

use Laminas\Form\FormElementManager;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use UserManager\Form\Login;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container) : LoginHandler
    {
        return new LoginHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(AuthenticationInterface::class),
            ($container->get(FormElementManager::class))->get(Login::class)
        );
    }
}
