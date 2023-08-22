<?php

declare(strict_types=1);

namespace UserManager\Form;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class LoginFactory
{
    /** @inheritDoc */
    public function __invoke(ContainerInterface $container): Login
    {
        return new Login();
    }
}
