<?php $firstPost = reset($posts); ?>
<?php $tagDescriptive = $firstPost['tags'][0];  ?>
<?php $description = "Listado de artículos del Blog de Albo bajo la categoría $tagDescriptive"; ?>
<?php $title = $tagDescriptive; ?>
<?php include 'header.php'; ?>
<main>
    <p>
        <a href="."><?= $_ENV['BLOG_TITLE'] ?></a>
    </p>
    <h1><?= $tagDescriptive ?></h1>
<?php foreach($posts as $post): ?>
        <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
        <?php extract($post); ?>
        <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>

