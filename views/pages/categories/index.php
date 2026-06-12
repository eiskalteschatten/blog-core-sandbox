<?php
/** @var array $pagination */
/** @var \BlogCore\Core\Config $config */
$pageTitle = 'Categories';
?>
<h1>Categories</h1>
<p class="meta"><?= $pagination['total'] ?> categor<?= $pagination['total'] !== 1 ? 'ies' : 'y' ?></p>

<?php if (!empty($pagination['items'])): ?>
    <div class="card-grid">
        <?php foreach ($pagination['items'] as $category): ?>
            <a class="card" href="/categories/<?= htmlspecialchars($category['slug']) ?>">
                <h3><?= htmlspecialchars($category['title']) ?></h3>
                <?php if (!empty($category['description'])): ?>
                    <p><?= htmlspecialchars($category['description']) ?></p>
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
    <p>No categories found.</p>
<?php endif ?>
