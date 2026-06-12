<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' — ' : '' ?><?= htmlspecialchars($config->getSiteTitle()) ?></title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            background: #f8f9fa;
            color: #212529;
            line-height: 1.6;
        }

        header {
            background: #1a1a2e;
            color: #fff;
            padding: 1rem 2rem;
        }

        header a { color: #fff; text-decoration: none; font-size: 1.25rem; font-weight: 700; }

        nav {
            background: #16213e;
            padding: 0.5rem 2rem;
        }

        nav a {
            color: #adb5bd;
            text-decoration: none;
            margin-right: 1.5rem;
            font-size: 0.9rem;
        }

        nav a:hover { color: #fff; }

        main {
            max-width: 960px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
            font-size: 0.85rem;
        }

        /* Cards */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin: 1.5rem 0;
        }

        .card {
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,.08);
            padding: 1.25rem;
            text-decoration: none;
            color: inherit;
            display: block;
            transition: box-shadow 0.2s;
        }

        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,.12); }

        .card h3 { margin: 0 0 0.5rem; font-size: 1.05rem; }
        .card p  { margin: 0; color: #6c757d; font-size: 0.88rem; }

        /* Pagination */
        .pagination { display: flex; gap: 0.5rem; margin: 2rem 0; align-items: center; }
        .pagination a, .pagination span {
            padding: 0.4rem 0.9rem;
            border-radius: 4px;
            background: #fff;
            border: 1px solid #dee2e6;
            color: #495057;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .pagination a:hover { background: #e9ecef; }
        .pagination .current { background: #1a1a2e; color: #fff; border-color: #1a1a2e; }

        /* Tags */
        .tag-list { display: flex; flex-wrap: wrap; gap: 0.4rem; margin: 0.75rem 0; }
        .tag {
            background: #e9ecef;
            color: #495057;
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
            font-size: 0.8rem;
            text-decoration: none;
        }
        .tag:hover { background: #dee2e6; }

        /* Post content */
        .post-content { background: #fff; border-radius: 6px; padding: 2rem; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .post-content h1, .post-content h2, .post-content h3 { line-height: 1.3; }
        .post-content pre { background: #f1f3f5; padding: 1rem; border-radius: 4px; overflow-x: auto; }
        .post-content code { background: #f1f3f5; padding: 0.1rem 0.35rem; border-radius: 3px; font-size: 0.88em; }
        .post-content pre code { background: none; padding: 0; }

        /* Section header */
        .section-title { margin: 2rem 0 0.75rem; font-size: 1.3rem; color: #343a40; }

        /* Meta line */
        .meta { color: #6c757d; font-size: 0.85rem; margin-bottom: 0.5rem; }
    </style>
    <link rel="alternate" type="application/rss+xml" title="<?= htmlspecialchars($config->getSiteTitle()) ?>" href="<?= htmlspecialchars($config->getSiteUrl()) ?>/feed.xml">
</head>
<body>
    <header>
        <a href="/"><?= htmlspecialchars($config->getSiteTitle()) ?></a>
    </header>
    <nav>
        <a href="/">Home</a>
        <a href="/posts">Posts</a>
        <a href="/categories">Categories</a>
        <a href="/tags">Tags</a>
    </nav>
    <main>
        <?= $pageContent ?>
    </main>
    <footer>
        &copy; <?= date('Y') ?> <?= htmlspecialchars($config->getSiteTitle()) ?>
        &nbsp;&middot;&nbsp;
        <a href="/feed.xml">RSS Feed</a>
        &nbsp;&middot;&nbsp;
        <a href="/sitemap.xml">Sitemap</a>
    </footer>
</body>
</html>
