<?php

declare(strict_types=1);

namespace Log;

use Log\Processor\RamseyUuidProcessor;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class LogFactory
{
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        $logger = new Logger('app');
        $logger->pushHandler($container->get(RepositoryHandler::class));
        $logger->pushProcessor(new RamseyUuidProcessor());
        $logger->pushProcessor(new PsrLogMessageProcessor(null, false));
        return $logger;
    }
}
