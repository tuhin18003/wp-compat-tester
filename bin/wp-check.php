<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WPCompat\Scanner;

$pluginDir = $argv[1] ?? dirname(__DIR__) . '/your-plugin-directory';

$scanner = new Scanner($pluginDir);
$scanner->run();