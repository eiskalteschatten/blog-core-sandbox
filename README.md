# Blog Core Sandbox

## Commands

All commands are run from the project root.

| Command | Description |
|---|---|
| `php -S localhost:8000 -t public` | Runs the development server. |
| `composer run build-index` | Builds the blog index (posts, categories, pagination, feed, sitemap). |
| `composer run import-wordpress -- --url https://example.com` | Imports posts and categories from a WordPress site via the REST API. Pass `--post <slug>` to import a single post, `--force` to re-import existing posts, `--auth username:app-password` to include drafts, and `-v` for verbose output. |
| `composer run import-wordpress-xml -- --file export.xml` | Imports posts, categories, tags, and comments from a WordPress WXR export file. Drafts are included automatically. Pass `--post <slug>` to import a single post, `--force` to re-import existing posts, `--skip-images` to skip image downloading, and `-v` for verbose output. |
| `composer run process-images` | Resizes and converts post images to WebP using the Imagick extension. Pass `-v` for verbose output. |
| `composer run build-process-images -- -v` | Runs build index, then processes post images in one command. |
| `composer run publish-blogcore-assets` | Creates a symlink from `public/blog-core` to the core package's `assets/` directory. |
| `composer run snapshot-comments [-- "message"]` | Interactively snapshots changed `posts/**/comments.json` files into a Git commit. |
| `composer run rsync-media-originals -- <user@host:/path/to/media-originals/posts/> [--apply]` | Syncs local media originals to a server with `rsync` (dry-run by default). |
| `composer run rsync-processed-images -- <user@host:/path/to/public/images/posts/> [--apply]` | Syncs processed WebP images to a server with `rsync` (dry-run by default). |
| `composer run process-rsync-images -- --originals <user@host:/path/to/media-originals/posts/> --processed <user@host:/path/to/public/images/posts/> [--apply] [--skip-process]` | Runs image processing, then syncs originals and processed images in one command. |

## Media Originals

Original source images are stored in `media-originals/posts/YYYY/MM/{slug}/` and are excluded from git.
The image processing command reads from this directory and writes generated WebP files to `public/images/posts/{slug}/`.

## Syncing Media to Server

Use the helper script to deploy originals separately from git:

```bash
composer run rsync-media-originals -- deploy@example.com:/var/www/blog/media-originals/posts/
composer run rsync-media-originals -- deploy@example.com:/var/www/blog/media-originals/posts/ --apply
```

The first command is a dry-run. The second performs the transfer.
The sync mirrors local to remote and uses `--delete`, so remove stale files on your machine before running `--apply` if you want them removed on the server.

You can do the same for processed images:

```bash
composer run rsync-processed-images -- deploy@example.com:/var/www/blog/public/images/posts/
composer run rsync-processed-images -- deploy@example.com:/var/www/blog/public/images/posts/ --apply
```

Or run processing + both syncs in one shortcut:

```bash
composer run process-rsync-images -- \
	--originals deploy@example.com:/var/www/blog/media-originals/posts/ \
	--processed deploy@example.com:/var/www/blog/public/images/posts/

composer run process-rsync-images -- \
	--originals deploy@example.com:/var/www/blog/media-originals/posts/ \
	--processed deploy@example.com:/var/www/blog/public/images/posts/ \
	--apply
```

Pass `--skip-process` if you already ran `composer run process-images` and only want to sync.

## Build + Process Shortcut

Run build index and image processing back-to-back:

```bash
composer run build-process-images
composer run build-process-images -- -v
```

Any flags are passed to both underlying commands.

## Comment Snapshots

When users submit comments, they are stored in `posts/**/comments.json`.
To preserve those changes in Git without auto-committing from the app, use the interactive snapshot helper:

```bash
composer run snapshot-comments
composer run snapshot-comments -- "comments snapshot 2026-07-16"
```

The script only stages changed `comments.json` files, shows a summary, and asks for confirmation before creating a commit.
