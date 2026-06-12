#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Build (or rebuild) the SQLite index from the filesystem.
 *
 * Usage:
 *   php bin/build_index.php          # silent
 *   php bin/build_index.php -v       # verbose
 *   php bin/build_index.php --verbose
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use BlogCore\Builders\IndexBuilder;
use Sandbox\Config\BlogConfig;

$verbose = in_array('-v', $argv ?? [], true)
        || in_array('--verbose', $argv ?? [], true);

$config  = new BlogConfig();
$builder = new IndexBuilder($config);

try {
    $builder->build($verbose);
    echo "Done." . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
