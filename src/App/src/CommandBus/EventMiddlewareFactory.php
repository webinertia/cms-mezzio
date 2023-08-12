<?php

declare(strict_types=1);

namespace App\CommandBus;

use DebugBar\DebugBar;
use League\Tactician\CommandEvents\EventMiddleware;
use League\Tactician\CommandEvents\Event\CommandHandled;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Webinertia\Utils\Debug;

final class EventMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): EventMiddleware
    {
        // todo setup command logging.
        $logger = $container->get(LoggerInterface::class);
        //$debug  = $container->get(DebugBar::class);
        $events = new EventMiddleware();
        $events->addListener(
            'command.handled',
            function (CommandHandled $event) use ($logger) {
                $command = $event->getCommand();
                //$debug['messages']->addMessage(Debug::dump($command->getCommandName(), 'command event', false, false));
            }
        );
        $events->addListener(
            'command.failed',
            function (CommandHandled $event) use ($logger) {
                $command = $event->getCommand();
                //$debug['messages']->addMessage(Debug::dump($command->getCommandName(), 'command event', false, false));
            }
        );
        return $events;
    }
}

