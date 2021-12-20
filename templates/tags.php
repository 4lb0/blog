<?php $tagDescriptive = ucwords(str_replace('-', ' ', $tag), ' ');  ?>
<?php $description = "Listado de artículos del Blog de Albo bajo la categoría $tagDescriptive"; ?>
<?php $title = "Tag $tag"; ?>
<?php include 'header.php'; ?>
<main>
    <p class="ctr">
        <?= getenv('BLOG_LOGO') ?? BLOG_DEFAULT_LOGO ?>
        <a href="."><?= getenv('BLOG_TITLE') ?></a>
    </p>
    <h1><?= $tagDescriptive ?></h1>
    <p class="ctr lg"><?= $description ?></p>
<?php foreach($posts as $post): ?>
        <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
        <?php extract($post); ?>
        <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>

