<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use BlogCore\Application;
use Sandbox\Config\BlogConfig;

$config = new BlogConfig();
$app    = new Application($config);

// -----------------------------------------------------------------------
// Register any sandbox-specific routes here, e.g.:
// $app->addRoute('GET', '/about', function () use ($app): void {
//     // ...
// });
// -----------------------------------------------------------------------

$app->run();
