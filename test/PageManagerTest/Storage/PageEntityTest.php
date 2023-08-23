<?php

declare(strict_types=1);

namespace PageManagerTest\Storage;

use PageManager\Storage\PageEntity;
use PHPUnit\Framework\TestCase;
use Stdlib\Content\ContentInterface;

final class PageEntityTest extends TestCase
{
    protected array $arrayId      = ['field' => 1];
    protected int $id             = 1;
    protected string $title       = 'Foo Bar';
    protected string $description = 'Foo Bar Baz Bat';

    public function testImplementsContentInterface(): void
    {
        $page = new PageEntity();
        $this->assertInstanceOf(ContentInterface::class, $page);
    }

    public function testEntityAcceptsConstructorArgs(): void
    {
        $page = new PageEntity(
            $this->id,
            $this->title,
            $this->description
        );
        $id = $page->getId();
        $title = $page->getTitle();
        $description = $page->getDescription();
        $this->assertEquals($this->id, $id, 'setting id failed');
        $this->assertEquals($this->title, $title, 'settings title failed');
        $this->assertEquals($this->description, $description, 'setting description failed');
    }

    public function testEntitySetters(): void
    {
        $page = new PageEntity();
        $page->setId($this->id);
        $page->setTitle($this->title);
        $page->setDescription($this->description);
        $id = $page->getId();
        $title = $page->getTitle();
        $description = $page->getDescription();
        $this->assertEquals($this->id, $id);
        $this->assertEquals($this->title, $title);
        $this->assertEquals($this->description, $description);
    }

    public function testEntityAcceptsArrayId(): void
    {
        $page = new PageEntity($this->arrayId);
        $id = $page->getId();
        $this->assertIsArray($id);
    }
}
