<?php include 'header.php'; ?>
<main>
    <p class="text-center">
        <img alt="Foto de Albo" src="profile.webp" width="100" height="100" />
    </p>
    <h1 class="text-center">
        <?= getenv('BLOG_LOGO') ?? BLOG_DEFAULT_LOGO ?> <?= getenv('BLOG_TITLE') ?>
    </h1>
<?php foreach($posts as $post): ?>
    <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
    <?php extract($post); ?>
    <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>
