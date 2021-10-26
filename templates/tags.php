<?php $title = "Tag $tag - Blog de Albo"; ?>
<?php include __DIR__ . '/header.php'; ?>
<main>
    <p><a href=".">← Ver todos los artículos</a>
    <h1><?= ucfirst($tag) ?></h1>
    <ul>
<?php foreach($posts as $post): ?>
        <li>
            <h3><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h3>
            <?php extract($post); ?>
            <?php include __DIR__ . '/_post.php'; ?>
        </li>
<?php endforeach; ?>
    </ul>
</main>
<?php include __DIR__ . '/footer.php'; ?>

