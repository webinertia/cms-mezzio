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
        /** @var RepositoryHandler */
        $repoHandler = $container->get(RepositoryHandler::class);
        $logger->pushHandler($repoHandler);
        $processor = new RamseyUuidProcessor();
        $logger->pushProcessor($processor);
        $processor = new PsrLogMessageProcessor(null, false);
        $logger->pushProcessor($processor);
        return $logger;
    }
}
