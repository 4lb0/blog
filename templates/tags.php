<?php $title = "Tag $tag"; ?>
<?php include __DIR__ . '/header.php'; ?>
<main>
    <p><a href=".">← Ver todos los artículos</a>
    <h1 class="text-center"><?= ucwords($tag, ' -') ?></h1>
<?php foreach($posts as $post): ?>
        <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h3>
        <?php extract($post); ?>
        <?php include __DIR__ . '/_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include __DIR__ . '/footer.php'; ?>

