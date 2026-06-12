#!/usr/bin/env php
<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use BlogCore\Commands\ProcessImagesCommand;
use Sandbox\Config\BlogConfig;

ProcessImagesCommand::run(new BlogConfig(), $argv);
echo "Done." . PHP_EOL;
