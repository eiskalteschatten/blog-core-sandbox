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
| `bin/rsync_media_originals.sh <user@host:/path/to/media-originals/posts/> [--apply]` | Syncs local media originals to a server with `rsync` (dry-run by default). |
| `bin/rsync_processed_images.sh <user@host:/path/to/public/images/posts/> [--apply]` | Syncs processed WebP images to a server with `rsync` (dry-run by default). |

## Media Originals

Original source images are stored in `media-originals/posts/YYYY/MM/{slug}/` and are excluded from git.
The image processing command reads from this directory and writes generated WebP files to `public/images/posts/{slug}/`.

## Syncing Media Originals to Server

Use the helper script to deploy originals separately from git:

```bash
bin/rsync_media_originals.sh deploy@example.com:/var/www/blog/media-originals/posts/
bin/rsync_media_originals.sh deploy@example.com:/var/www/blog/media-originals/posts/ --apply
```

The first command is a dry-run. The second performs the transfer.
The sync mirrors local to remote and uses `--delete`, so remove stale files on your machine before running `--apply` if you want them removed on the server.

You can do the same for processed images:

```bash
bin/rsync_processed_images.sh deploy@example.com:/var/www/blog/public/images/posts/
bin/rsync_processed_images.sh deploy@example.com:/var/www/blog/public/images/posts/ --apply
```
