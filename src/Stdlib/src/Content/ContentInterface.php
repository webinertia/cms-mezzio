<?php

declare(strict_types=1);

namespace Stdlib\Content;

use \DateTimeImmutable;

interface ContentInterface
{
    public function getId(): array|int|string|null;
    public function setId(array|int|string|null $id): self;
    public function getTitle(): ?string;
    public function setTitle(string $title): self;
    public function getDescription(): ?string;
    public function setDescription(string $description): self;
}
