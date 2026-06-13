<?php
/** @var string $query */
/** @var array|null $pagination */
$pageTitle = 'Search';
?>
<h1>Search</h1>

<form action="/search" method="get">
    <input type="search" name="q" value="<?= htmlspecialchars($query) ?>" placeholder="Search posts…" autofocus>
    <button type="submit">Search</button>
</form>

<?php if ($query !== ''): ?>
    <?php if ($pagination !== null && $pagination['total'] > 0): ?>
        <p class="meta"><?= $pagination['total'] ?> result<?= $pagination['total'] !== 1 ? 's' : '' ?> for &ldquo;<?= htmlspecialchars($query) ?>&rdquo;</p>

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
                    <a href="?q=<?= urlencode($query) ?>&page=<?= $pagination['prevPage'] ?>">&laquo; Previous</a>
                <?php endif ?>
                <span class="current">Page <?= $pagination['currentPage'] ?> of <?= $pagination['lastPage'] ?></span>
                <?php if ($pagination['hasNext']): ?>
                    <a href="?q=<?= urlencode($query) ?>&page=<?= $pagination['nextPage'] ?>">Next &raquo;</a>
                <?php endif ?>
            </div>
        <?php endif ?>
    <?php else: ?>
        <p>No results found for &ldquo;<?= htmlspecialchars($query) ?>&rdquo;.</p>
    <?php endif ?>
<?php endif ?>
