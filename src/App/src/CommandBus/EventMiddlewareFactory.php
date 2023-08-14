<?php

declare(strict_types=1);

namespace App\CommandBus;

use League\Tactician\CommandEvents\EventMiddleware;
use League\Tactician\CommandEvents\Event\CommandHandled;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Monolog\Logger;

final class EventMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): EventMiddleware
    {
        /**
         * This will most likely end up being moved to a listener class so that
         * we end up with one listener class per channel
         */
        /** @var Logger $logger */
        $logger = $container->get(LoggerInterface::class);
        $logger = $logger->withName('command-bus'); // set the channel
        $events = new EventMiddleware();
        $events->addListener(
            'command.handled',
            function (CommandHandled $event) use ($logger) {
                $logger->info(
                    'Handled {command} successfully.', // success message
                    [
                        'command' => ($event->getCommand())->getCommandName(),
                    ]
                );
                $logger->close();
            }
        );
        $events->addListener(
            'command.failed',
            function (CommandHandled $event) use ($logger) {
                $logger->info(
                    '{command} failed.', // failure message
                    [
                        'command' => ($event->getCommand())->getCommandName(),
                    ]
                );
                $logger->close();
            }
        );
        return $events;
    }
}

