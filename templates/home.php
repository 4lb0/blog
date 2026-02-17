<?php

$description = <<<EOD
Cuando me acuerdo, escribo aca sobre programación. Si ves algo mal, una IA lo hizo. Más sobre mí en <a href="//albo.ar">albo.ar</a>.
EOD;
?>
<?php include 'header.php'; ?>
<main>
    <h1>
        <?= BLOG_TITLE ?>
    </h1>
    <p>
        <em>
            <?= $description ?>
        </em>
    </p>
<?php foreach($posts as $post): ?>
    <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
    <?php extract($post); ?>
    <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>
