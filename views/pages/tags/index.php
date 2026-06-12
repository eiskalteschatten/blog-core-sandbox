<?php
/** @var array $tags */
/** @var \BlogCore\Core\Config $config */
$pageTitle = 'Tags';
?>
<h1>Tags</h1>
<p class="meta"><?= count($tags) ?> tag<?= count($tags) !== 1 ? 's' : '' ?></p>

<?php if (!empty($tags)): ?>
    <div class="tag-list" style="margin-top:1rem">
        <?php foreach ($tags as $tag): ?>
            <a class="tag" href="/tags/<?= htmlspecialchars($tag['slug']) ?>">
                <?= htmlspecialchars($tag['name']) ?>
            </a>
        <?php endforeach ?>
    </div>
<?php else: ?>
    <p>No tags found.</p>
<?php endif ?>
