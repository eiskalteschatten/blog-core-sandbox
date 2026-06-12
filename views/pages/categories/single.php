<?php
/** @var array $category */
/** @var array $pagination */
/** @var \BlogCore\Core\Config $config */
$pageTitle = $category['title'];
?>
<h1><?= htmlspecialchars($category['title']) ?></h1>

<?php if (!empty($category['description'])): ?>
    <p><?= htmlspecialchars($category['description']) ?></p>
<?php endif ?>

<p class="meta"><?= $pagination['total'] ?> post<?= $pagination['total'] !== 1 ? 's' : '' ?></p>

<?php if (!empty($pagination['items'])): ?>
    <div class="card-grid">
        <?php foreach ($pagination['items'] as $post): ?>
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

    <?php if ($pagination['lastPage'] > 1): ?>
        <div class="pagination">
            <?php if ($pagination['hasPrev']): ?>
                <a href="?page=<?= $pagination['prevPage'] ?>">&laquo; Previous</a>
            <?php endif ?>
            <span class="current">Page <?= $pagination['currentPage'] ?> of <?= $pagination['lastPage'] ?></span>
            <?php if ($pagination['hasNext']): ?>
                <a href="?page=<?= $pagination['nextPage'] ?>">Next &raquo;</a>
            <?php endif ?>
        </div>
    <?php endif ?>
<?php else: ?>
    <p>No posts in this category yet.</p>
<?php endif ?>

<p style="margin-top:1.5rem">
    <a href="/categories">&larr; All categories</a>
</p>
