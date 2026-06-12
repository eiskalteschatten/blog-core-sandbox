#!/usr/bin/env php
<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use BlogCore\Commands\ImportWordPressCommand;
use Sandbox\Config\BlogConfig;

ImportWordPressCommand::run(new BlogConfig(), $argv);
