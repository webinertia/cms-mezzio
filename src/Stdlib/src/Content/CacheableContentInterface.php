<?php

declare(strict_types=1);

namespace Stdlib\Content;

use DateTimeImmutable;

interface CacheableContentInterface
{
    public function getLastModified(): DateTimeImmutable|int|string|null;
    public function setLastModified(DateTimeImmutable|int|string $lastModified): self;
}
