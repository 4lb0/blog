<?php $tagDescriptive = ucwords(str_replace('-', ' ', $tag), ' ');  ?>
<?php $description = "Listado de artículos del Blog de Albo bajo la categoría $tagDescriptive"; ?>
<?php $title = "Tag $tag"; ?>
<?php include 'header.php'; ?>
<main>
    <p><a href=".">← Ver todos los artículos</a>
    <h1 class="ctr"><?= $tagDescriptive ?></h1>
<?php foreach($posts as $post): ?>
        <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
        <?php extract($post); ?>
        <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>

