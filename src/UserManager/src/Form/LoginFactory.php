<?php

declare(strict_types=1);

namespace UserManager\Form;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class LoginFactory implements FactoryInterface
{
    /** @inheritDoc */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Login
    {
        if ($options !== null) {
            return new $requestedName(options: $options);
        }
        return new $requestedName();
    }
}
