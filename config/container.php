<?php

declare(strict_types=1);

use Laminas\ServiceManager\ServiceManager;

/**
 * @psalm-suppress all
 */
$config = require __DIR__ . '/config.php';

$dependencies                       = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);
