<?php
/** @var array $post */
/** @var array $categories */
/** @var array $tags */
/** @var array $comments */
/** @var \BlogCore\Core\Config $config */
$pageTitle = $post['title'];
?>
<div class="post-content">
    <h1><?= htmlspecialchars($post['title']) ?></h1>

    <?php if (!empty($post['published_at'])): ?>
        <p class="meta">Published <?= date('F j, Y', strtotime($post['published_at'])) ?></p>
    <?php endif ?>

    <?php if (!empty($categories)): ?>
        <div class="tag-list">
            <?php foreach ($categories as $cat): ?>
                <a class="tag" href="/categories/<?= htmlspecialchars($cat['slug']) ?>"><?= htmlspecialchars($cat['title']) ?></a>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <hr>

    <?= $post['content_html'] ?>

    <?php if (!empty($tags)): ?>
        <hr>
        <div class="tag-list">
            <?php foreach ($tags as $tag): ?>
                <a class="tag" href="/tags/<?= htmlspecialchars($tag['slug']) ?>"><?= htmlspecialchars($tag['name']) ?></a>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <?php if (!empty($comments)): ?>
        <hr>
        <h2>Comments (<?= count($comments) ?>)</h2>
        <div class="comments-list">
            <?php foreach ($comments as $comment): ?>
                <?php
                $author = trim((string)($comment['author'] ?? '')) ?: 'Anonymous';
                $dateRaw = (string)($comment['comment_date'] ?? $comment['date'] ?? '');
                $content = (string)($comment['content'] ?? '');
                ?>
                <article class="comment-item">
                    <p>
                        <strong><?= htmlspecialchars($author) ?></strong>
                        <?php if ($dateRaw !== ''): ?>
                            <span> on <?= htmlspecialchars(date('F j, Y H:i', strtotime($dateRaw))) ?></span>
                        <?php endif ?>
                    </p>
                    <div><?= nl2br(htmlspecialchars($content), false) ?></div>
                </article>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>

<p style="margin-top:1.5rem">
    <a href="/posts">&larr; Back to all posts</a>
</p>
