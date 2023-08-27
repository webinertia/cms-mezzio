<?php

declare(strict_types=1);

namespace PageManagerTest;

use PageManager\ConfigProvider;
use PHPUnit\Framework\TestCase;

use function array_key_exists;

final class ConfigProviderTest extends TestCase
{
    private array $config;

    protected function setUp(): void
    {
        $provider     = new ConfigProvider();
        $this->config = $provider();
    }

    public function testInvocationProvidesDependencyConfig(): void
    {
        self::assertTrue(array_key_exists('dependencies', $this->config));
    }
}
