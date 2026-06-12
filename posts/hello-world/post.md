# Hello World

Welcome to **blog-core** — a file-system-based blog package written in vanilla PHP.

## What is this?

This post is a sample entry stored as a plain Markdown file alongside a `meta.json` metadata file.
The `blog-core` package parses these files, converts the Markdown to HTML, and indexes everything
into a lightweight SQLite database.

## Features

- Pure vanilla PHP — no framework required
- Markdown posts with per-post `meta.json` metadata
- Categories defined in JSON files
- Tags derived from post metadata
- SQLite-backed index rebuilt via a CLI script
- Default routes for posts, categories, and tags
- RSS feed and sitemap built in

## Getting Started

Run the index builder to populate the database:

```bash
php bin/build_index.php --verbose
```

Then start the built-in PHP server:

```bash
php -S localhost:8000 -t public/
```

Open [http://localhost:8000](http://localhost:8000) and explore.
