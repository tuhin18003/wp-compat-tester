<?php
namespace WPCompat;

class DynamicDeprecatedFunctions
{
    private const FILES = [
        'functions.php',
        'deprecated.php',
    ];

    private const BASE_URL = 'https://raw.githubusercontent.com/WordPress/WordPress/master/wp-includes/';

    public static function fetch(): array
    {
        $map = [];

        foreach (self::FILES as $file) {
            $url = self::BASE_URL . $file;
            $content = @file_get_contents($url);

            if ($content) {
                preg_match_all(
                    "/_deprecated_function\\s*\\(\\s*'([^']+)'\\s*,\\s*'([^']+)'/",
                    $content,
                    $matches,
                    PREG_SET_ORDER
                );

                foreach ($matches as $match) {
                    [$_, $func, $version] = $match;
                    $map[$func] = $version;
                }
            }
        }

        return $map;
    }
}