<?php

declare(strict_types=1);

namespace UserManager\Auth;

use Mezzio\Authentication\UserInterface;
use Psr\Container\ContainerInterface;
use Webmozart\Assert\Assert;

/**
 * Produces a callable factory capable of itself producing a UserInterface
 * instance; this approach is used to allow substituting alternative user
 * implementations without requiring extensions to existing repositories.
 */
class CurrentUserFactory
{
    /** @psalm-suppress PossiblyUnusedParam */
    public function __invoke(ContainerInterface $container): callable
    {
        return static function (string $identity, array $roles = [], array $details = []): UserInterface {
            Assert::allString($roles);
            Assert::isMap($details);

            return new CurrentUser($identity, $roles, $details);
        };
    }
}
