<?php if ($data): ?>
    <?php foreach ($data as $article): ?>

        <div class="post-preview">
            <a href="/blog/post?<?= $article->url; ?>">
                <h3 class="post-title">
                    <?= $article->title; ?>
                </h3>
            </a>
            <?php if ($article->image): ?>
                <img width="600" src="<?= $article->image; ?>" >
            <?php endif; ?>
            <p>
            <h5 class="post-subtitle">
                <?= $article->sub_title; ?>
            </h5>
            </p>

            <p class="post-meta">Posted by
                <a href="#"><?= $article->authorLogin; ?></a>
                <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $article->created_at); ?>
                on <?= $date->format('F d, Y'); ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>Articles not found!</p>
<?php endif; ?>