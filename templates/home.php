<?php $description = "Blog de Albo, artículos principalmente de desarrollo de software, programación, tecnología, devops y tal vez hasta UX"; ?>
<?php include 'header.php'; ?>
<main>
    <p class="ctr">
        <img alt="Foto de Albo" src="images/profile.png" width="150" height="150" />
    </p>
    <h1 class="ctr">
        <?= getenv('BLOG_LOGO') ?? BLOG_DEFAULT_LOGO ?> <?= getenv('BLOG_TITLE') ?>
    </h1>
<?php foreach($posts as $post): ?>
    <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
    <?php extract($post); ?>
    <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>
