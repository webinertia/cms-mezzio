<?php

declare(strict_types=1);

namespace PageManager\Storage;

use Webinertia\Db;
use Stdlib\Content\ContentInterface;

class PageEntity implements Db\EntityInterface, ContentInterface
{
    public function __construct(
        private array|int|string|null $id = null,
        private ?string $title = null,
        private ?string $description = null
    ) {
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ContentInterface
    {
        $this->description = $description;
        return $this;
    }

    public function getId(): array|int|string|null
    {
        return $this->id;
    }

    public function setId(array|int|string|null $id): ContentInterface
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): ContentInterface
    {
        $this->title = $title;
        return $this;
    }
}
