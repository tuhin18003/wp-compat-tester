<?php
namespace WPCompat;

class WordPressVersion
{
    public static function getLocalVersion(): ?string
    {
        $versionFile = dirname(__DIR__, 2) . '/wp-includes/version.php';
        if (!file_exists($versionFile)) return null;

        $contents = file_get_contents($versionFile);
        if (preg_match("/\$wp_version\s*=\s*'([^']+)'/", $contents, $m)) {
            return $m[1];
        }

        return null;
    }

    public static function getLatestVersion(): ?string
    {
        $json = @file_get_contents('https://api.wordpress.org/core/version-check/1.7/');
        if (!$json) return null;

        $data = json_decode($json, true);
        return $data['offers'][0]['current'] ?? null;
    }
}