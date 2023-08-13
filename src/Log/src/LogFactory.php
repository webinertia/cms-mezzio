<?php

declare(strict_types=1);

namespace Log;

use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class LogFactory
{
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        $logger = new Logger('app');
        $logger->pushProcessor(new PsrLogMessageProcessor(null, false));
        return $logger;
    }
}
