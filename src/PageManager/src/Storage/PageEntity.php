<?php

declare(strict_types=1);

namespace PageManager\Storage;

use SebastianBergmann\Type\NullType;
use Webinertia\Db;

final class PageEntity implements Db\EntityInterface
{
    public function __construct(
        private array|int|string|null $id = null,
        private string|null $title = null,
    ) {
    }

    public function getId(): array|int|string|null
    {
        return $this->id;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }
}
