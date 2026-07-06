# Blog Core Sandbox

## Commands

All commands are run from the project root.

| Command | Description |
|---|---|
| `php -S localhost:8000 -t public` | Runs the development server. |
| `php bin/build_index.php` | Builds the blog index (posts, categories, pagination, feed, sitemap). Pass `-v` / `--verbose` for detailed output. |
| `php bin/import_wordpress.php --url https://example.com` | Imports posts and categories from a WordPress site via the REST API. Pass `--post <slug>` to import a single post, `--force` to re-import existing posts, and `-v` for verbose output. |
| `php bin/process_images.php` | Resizes and converts post images to WebP using the Imagick extension. Pass `-v` for verbose output. |
| `php bin/publish_assets.php` | Creates a symlink from `public/blog-core` to the core package's `assets/` directory. Pass `-v` for verbose output. |
