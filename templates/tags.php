<?php $firstPost = reset($posts); ?>
<?php $tagDescriptive = $firstPost['tags'][0];  ?>
<?php $description = "Listado de artículos del Blog de Albo bajo la categoría $tagDescriptive"; ?>
<?php $title = $tagDescriptive; ?>
<?php include 'header.php'; ?>
<main>
    <h1>
        <a href="."><?= BLOG_TITLE ?></a>
    </h1>
    <h2>Posts archivados en <em><?= $tagDescriptive ?></em></h2>
<?php foreach($posts as $post): ?>
        <h3><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h3>
        <?php extract($post); ?>
        <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>

