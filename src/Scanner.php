<?php
namespace WPCompat;

use WPCompat\DynamicDeprecatedFunctions;
use WPCompat\WordPressVersion;

class Scanner
{
    private string $pluginPath;
    private array $deprecatedFunctions;

    public function __construct(string $pluginPath)
    {
        $this->pluginPath = $pluginPath;
        $this->deprecatedFunctions = DynamicDeprecatedFunctions::fetch();
    }

    public function run(): void
    {
        echo "\n🔍 Scanning plugin at: {$this->pluginPath}\n";

        $wpVersion = WordPressVersion::getLocalVersion();
        $latestVersion = WordPressVersion::getLatestVersion();

        echo "Local WP Version:  $wpVersion\n";
        echo "Latest WP Version: $latestVersion\n";

        $phpFiles = $this->getPhpFiles($this->pluginPath);
        foreach ($phpFiles as $file) {
            $this->scanFile($file);
        }

        echo "✅ Scan complete.\n";
    }

    private function getPhpFiles(string $dir): array
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
        return array_filter(iterator_to_array($iterator), fn($f) => $f->isFile() && $f->getExtension() === 'php');
    }

    private function scanFile($file): void
    {
        $path = $file->getPathname();
        $content = file_get_contents($path);

        foreach ($this->deprecatedFunctions as $fn => $deprecatedVersion) {
            if (preg_match("/\\b$fn\\s*\(/", $content)) {
                echo "\n⚠️  Deprecated function `$fn()` found in $path (deprecated since WP $deprecatedVersion)\n";
            }
        }

        if (preg_match("/add_action\\s*\(\\s*['\"]plugins_loaded['\"]", $content)) {
            echo "\n⚠️  Detected 'plugins_loaded' hook usage in $path. Use 'init' instead for translations in WP >= 6.7.\n";
        }
    }
}