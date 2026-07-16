<?php
/** @var array $post */
/** @var array $categories */
/** @var array $tags */
/** @var array $comments */
/** @var \BlogCore\Core\Config $config */
/** @var array|null $commentFormErrors */
/** @var array|null $commentFormOld */
$pageTitle = $post['title'];
$commentFormErrors = $commentFormErrors ?? [];
$commentFormOld = $commentFormOld ?? [];
$commentPosted = (string)($_GET['comment'] ?? '') === 'posted';
$commentAction = rtrim((string)$config->getRoutePrefix(), '/') . '/posts/' . rawurlencode((string)$post['slug']) . '/comments#comments';
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

    <hr>
    <section id="comments">
        <h2>Comments (<?= count($comments) ?>)</h2>

        <?php if ($commentPosted): ?>
            <p>Your comment was posted.</p>
        <?php endif ?>

        <?php if (!empty($commentFormErrors)): ?>
            <div>
                <?php foreach ($commentFormErrors as $error): ?>
                    <p><?= htmlspecialchars((string)$error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form method="post" action="<?= htmlspecialchars($commentAction) ?>" style="margin-bottom: 1.25rem;">
            <p>
                <label for="comment-author">Name</label><br>
                <input
                    id="comment-author"
                    name="author"
                    type="text"
                    maxlength="120"
                    value="<?= htmlspecialchars((string)($commentFormOld['author'] ?? '')) ?>"
                >
            </p>

            <p>
                <label for="comment-author-url">Website (optional)</label><br>
                <input
                    id="comment-author-url"
                    name="author_url"
                    type="url"
                    maxlength="2048"
                    value="<?= htmlspecialchars((string)($commentFormOld['author_url'] ?? '')) ?>"
                >
            </p>

            <p>
                <label for="comment-content">Comment</label><br>
                <textarea
                    id="comment-content"
                    name="content"
                    rows="6"
                    required
                    maxlength="10000"
                ><?= htmlspecialchars((string)($commentFormOld['content'] ?? '')) ?></textarea>
            </p>

            <p>
                <button type="submit">Post comment</button>
            </p>
        </form>

        <?php if (!empty($comments)): ?>
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
    </section>
</div>

<p style="margin-top:1.5rem">
    <a href="/posts">&larr; Back to all posts</a>
</p>
