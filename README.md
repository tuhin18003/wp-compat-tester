# WP Compat Tester

A CLI tool to scan your WordPress plugin code for compatibility issues with the latest WordPress version.

## Features
- Detects your local WordPress version
- Fetches the latest WordPress version from wordpress.org
- Scans plugin PHP files for deprecated functions (based on official GitHub source)
- Warns about improper usage of `plugins_loaded` for translations in WP 6.7+

## Installation (in your plugin project)

Inside your plugin project folder:

```bash
composer require --dev tuhin18003/wp-compat-tester
```

## Usage

### Option 1: Manually
Run the CLI tool directly:

```bash
vendor/bin/wp-check.php -- ./my-plugin-folder
```

Or scan multiple paths:

```bash
vendor/bin/wp-check.php -- ./my-plugin.php ./core
```

### Option 2: Add to composer scripts

In your plugin project's `composer.json`:

```json
"scripts": {
  "check:compat": "vendor/bin/wp-check.php -- ./my-plugin.php ./core"
}
```

Then run:

```bash
composer run check:compat
```

## Output Example
```
🔍 Scanning plugin at: ./my-plugin.php
Local WP Version:  6.7.0
Latest WP Version: 6.7.2

⚠️  Deprecated function `get_page_by_title()` found in plugin.php (deprecated since WP 6.2.0)
⚠️  Detected 'plugins_loaded' hook usage in plugin.php. Use 'init' instead for translations in WP >= 6.7.
✅ Scan complete.
```

## License
MIT
