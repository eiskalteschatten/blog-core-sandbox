#!/usr/bin/env php
<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use BlogCore\Commands\ImportWordPressXmlCommand;
use Sandbox\Config\BlogConfig;

ImportWordPressXmlCommand::run(new BlogConfig(), $argv);
