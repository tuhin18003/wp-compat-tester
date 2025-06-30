# WP Compat Tester

A CLI tool to scan your WordPress plugin code for compatibility issues with the latest WordPress version.

## Features
- Detects your local WordPress version
- Fetches the latest WordPress version from wordpress.org
- Scans plugin PHP files for deprecated functions (based on official GitHub source)
- Warns about improper usage of `plugins_loaded` for translations in WP 6.7+

## Installation

1. Clone this repository:
```bash
git clone https://github.com/yourname/wp-compat-tester.git
cd wp-compat-tester
```

2. Install dependencies:
```bash
composer install
```

## Usage

You can scan a plugin directory using:

```bash
composer run wp:check -- /full/path/to/plugin-directory
```

Or run directly:

```bash
php bin/wp-check.php /path/to/your-plugin
```

## Output Example
```
🔍 Scanning plugin at: /path/to/plugin
Local WP Version:  6.7.0
Latest WP Version: 6.7.2

⚠️  Deprecated function `get_page_by_title()` found in plugin.php (deprecated since WP 6.2.0)
⚠️  Detected 'plugins_loaded' hook usage in plugin.php. Use 'init' instead for translations in WP >= 6.7.
✅ Scan complete.
```

## License
MIT