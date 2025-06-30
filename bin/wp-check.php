<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WPCompat\Scanner;

array_shift($argv); // remove the script name

foreach ($argv as $pluginPath) {
    $scanner = new Scanner($pluginPath);
    $scanner->run();
}
