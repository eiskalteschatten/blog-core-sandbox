<?php
/** @var array $recentPosts */
/** @var array $featuredCategories */
/** @var \BlogCore\Core\Config $config */
?>
<h1><?= htmlspecialchars($config->getSiteTitle()) ?></h1>
<p class="meta">A file-system-based blog powered by blog-core.</p>

<?php if (!empty($featuredCategories)): ?>
    <h2 class="section-title">Featured Categories</h2>
    <div class="card-grid">
        <?php foreach ($featuredCategories as $category): ?>
            <a class="card" href="/categories/<?= htmlspecialchars($category['slug']) ?>">
                <h3><?= htmlspecialchars($category['title']) ?></h3>
                <?php if (!empty($category['description'])): ?>
                    <p><?= htmlspecialchars($category['description']) ?></p>
                <?php endif ?>
            </a>
        <?php endforeach ?>
    </div>
<?php endif ?>

<?php if (!empty($recentPosts)): ?>
    <h2 class="section-title">Recent Posts</h2>
    <div class="card-grid">
        <?php foreach ($recentPosts as $post): ?>
            <a class="card" href="/posts/<?= htmlspecialchars($post['slug']) ?>">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <?php if (!empty($post['description'])): ?>
                    <p><?= htmlspecialchars($post['description']) ?></p>
                <?php endif ?>
                <?php if (!empty($post['published_at'])): ?>
                    <p class="meta"><?= date('F j, Y', strtotime($post['published_at'])) ?></p>
                <?php endif ?>
            </a>
        <?php endforeach ?>
    </div>
<?php else: ?>
    <p>No posts yet. Run <code>php bin/build_index.php</code> to index your content.</p>
<?php endif ?>
