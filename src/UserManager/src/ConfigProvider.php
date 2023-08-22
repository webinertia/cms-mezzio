<?php

declare(strict_types=1);

namespace UserManager;

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\AuthenticationMiddleware;
use Mezzio\Authentication\Session\PhpSession;
use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;
use UserManager\Form;
use UserManager\Middleware;

/**
 * The configuration provider for the UserManager module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies'   => $this->getDependencies(),
            'templates'      => $this->getTemplates(),
            'authentication' => $this->getAuthConfig(),
            'routes'         => $this->getRoutes(),
            'form_elements'  => $this->getFormElementConfig(),
            'tactician'      => $this->getCommandConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'aliases'   => [
                AuthenticationInterface::class => PhpSession::class,
                UserRepositoryInterface::class => UserRepository::class,
            ],
            'factories' => [
                Auth\LoginCommandHandler::class      => Auth\LoginCommandHandlerFactory::class,
                Auth\CurrentUser::class              => Auth\CurrentUserFactory::class,
                Handler\LoginHandler::class          => Handler\LoginHandlerFactory::class,
                Handler\LogoutHandler::class         => Handler\LogoutHandlerFactory::class,
                Handler\ProfileHandler::class        => Handler\ProfileHandlerFactory::class,
                Middleware\IdentityMiddleware::class => Middleware\IdentityMiddlewareFactory::class,
                UserRepository::class                => UserRepositoryFactory::class,
                UserInterface::class                 => Auth\CurrentUserFactory::class,
            ],
            'invokables' => [
                Auth\LogoutCommandHandler::class => Auth\LogoutCommandHandler::class,
            ],
        ];
    }

    public function getAuthConfig(): array
    {
        return [
            'username' => 'userName',
            'password' => 'password',
            'details'  => ['email', 'firstName', 'lastName', 'birthday'],
            'redirect' => '/user/login',
        ];
    }

    public function getRoutes(): array
    {
        return [
            [
                'path'            => '/user/login',
                'name'            => 'user.login',
                'middleware'      => [
                    Handler\LoginHandler::class,
                ],
                'allowed_methods' => ['GET', 'POST'],
            ],
            [
                'path'            => '/user/profile[/{userName:[a-zA-Z]+}]',
                'name'            => 'user.profile',
                'middleware'      => [
                    AuthenticationMiddleware::class,
                    Handler\ProfileHandler::class,
                ],
                'allowed_methods' => ['GET'],
            ],
            [
                'path'            => '/user/logout',
                'name'            => 'user.logout',
                'middleware'      => [
                    AuthenticationMiddleware::class,
                    Handler\LogoutHandler::class,
                ],
                'allowed_methods' => ['GET'],
            ],
        ];
    }

    public function getFormElementConfig(): array
    {
        return [
            'factories' => [
                Form\Login::class => Form\LoginFactory::class,
            ],
        ];
    }

    public function getCommandConfig(): array
    {
        return [
            'handler-map' => [
                Auth\LoginCommand::class  => Auth\LoginCommandHandler::class,
                Auth\LogoutCommand::class => Auth\LogoutCommandHandler::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'user-manager' => [__DIR__ . '/../templates/user-manager'],
            ],
        ];
    }
}
