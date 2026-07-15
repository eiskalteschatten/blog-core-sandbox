# Getting Started

This is a second sample post in the `general` category.

## Directory Layout

Each post lives in its own subdirectory under `posts/`, organized by `YYYY/MM`:

```
posts/
└── 2026/
    └── 06/
        ├── hello-world/
        │   ├── meta.json   ← title, slug, tags, categories, etc.
        │   └── post.md     ← the post body in Markdown
        └── getting-started/
            ├── meta.json
            └── post.md
```

## Adding a New Post

1. Create a new directory under `posts/YYYY/MM/` using your post slug.
2. Add `meta.json` with at minimum `title`, `slug`, and `publishedAt`.
3. Add `post.md` with your Markdown content.
4. Run `php bin/build_index.php` to update the index.

The post will appear immediately on the next page load.
