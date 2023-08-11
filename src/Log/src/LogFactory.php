<?php

declare(strict_types=1);

namespace Log;

use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class LogFactory
{
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        return new Logger('app');
    }
}
