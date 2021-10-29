<?php $title = "Tag $tag"; ?>
<?php include 'header.php'; ?>
<main>
    <p><a href=".">← Ver todos los artículos</a>
    <h1 class="text-center"><?= ucwords(str_replace('-', ' ', $tag), ' ') ?></h1>
<?php foreach($posts as $post): ?>
        <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h3>
        <?php extract($post); ?>
        <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>

