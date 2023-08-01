<?php

declare(strict_types=1);

namespace UserManager\Form\Fieldset;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class LoginFieldsetFactory implements FactoryInterface
{
    /** @inheritDoc */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): LoginFieldset
    {
        if ($options !== null) {
            return new $requestedName(options: $options);
        }
        return new $requestedName();
    }
}
