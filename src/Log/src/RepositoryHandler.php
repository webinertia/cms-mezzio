<?php

declare(strict_types=1);

namespace Log;

use Laminas\Db\TableGateway\TableGatewayInterface;
use Monolog\Level;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

final class RepositoryHandler extends AbstractProcessingHandler
{
    public function __construct(
        private TableGatewayInterface $gateway,
        protected Level $level = Level::Debug,
        protected bool $bubble = true
    ) {
    }

    protected function write(LogRecord $record): void
    {
        $message = [
            'channel' => $record['channel'],
            'level'   => $record['level_name'],
            'uuid'    => $record['extra']['uuid'] ?? null,
            'message' => $record->formatted,
            'time'    => $record->datetime->format('U'),
            'userName' => $record['extra']['userName'] ?? null,
        ];
        // todo wrap this in a try catch
        $result = $this->gateway->insert($message);
    }
}
