<?php include __DIR__ . '/header.php'; ?>
<main>
    <p class="text-center">
        <img alt="Photo of Albo" src="profile.webp" width="100" height="100" />
    </p>
    <h1 class="text-center">
        <?= \Blog\DevServer::LOGO ?> <?= \Blog\DevServer::TITLE ?>
    </h1>
<?php foreach($posts as $post): ?>
    <h3><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h3>
    <?php extract($post); ?>
    <?php include __DIR__ . '/_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include __DIR__ . '/footer.php'; ?>
