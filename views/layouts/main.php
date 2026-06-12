<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' — ' : '' ?><?= htmlspecialchars($config->getSiteTitle()) ?></title>

    <link rel="alternate" type="application/rss+xml" title="<?= htmlspecialchars($config->getSiteTitle()) ?>" href="<?= htmlspecialchars($config->getSiteUrl()) ?>/feed.xml">

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/blog-core/css/image-carousel.css">

    <script src="/blog-core/scripts/image-carousel/index.js" defer></script>
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
