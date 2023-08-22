<?php

declare(strict_types=1);

namespace Log\Processor;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use Ramsey\Uuid\Exception\UnsupportedOperationException;
use Ramsey\Uuid\Uuid;

final class RamseyUuidProcessor implements ProcessorInterface
{
    /**
     *
     * @param LogRecord $record
     * @return LogRecord
     * @throws UnsupportedOperationException
     */
    public function __invoke(LogRecord $record)
    {
        $record->extra['uuid'] = (Uuid::uuid7($record->datetime))->toString();
        return $record;
    }
}
