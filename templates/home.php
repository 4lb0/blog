<?php $description = "Blog de Albo, artículos principalmente de desarrollo de software, programación, tecnología, devops y tal vez hasta UX"; ?>
<?php include 'header.php'; ?>
<main>
    <h1>
        <?= getenv('BLOG_LOGO') ?? BLOG_DEFAULT_LOGO ?> <?= getenv('BLOG_TITLE') ?>
    </h1>
    <p class="ctr" style="font-size: 1.3em"><?= $description ?></p>
<?php foreach($posts as $post): ?>
    <h2 class="sp"><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
    <?php extract($post); ?>
    <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>
