<?php
$article=$data;
if ($article):?>
    <div class="post-heading">
        <h3><?= $article->title; ?></h3>
        <?php if ($article->image): ?>
            <img width="600" src="<?= $article->image; ?>" >
        <?php endif; ?>
        <h5 class="subheading"><?= $article->sub_title; ?></h5>
        <p><?= $article->content; ?></p>
        <br>
        <span class="meta">Posted by
                            <a href="#"><?= $article->authorLogin; ?></a>
            <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $article->created_at); ?>
            on <?= $date->format('F d, Y'); ?></span>
    </div>
    <hr>
<?php else: ?>
    <p>Article not found!</p>
<?php endif; ?>