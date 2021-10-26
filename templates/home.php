<?php include __DIR__ . '/header.php'; ?>
<main>
    <p class="text-center">
        <img src="images/profile.png" alt="" width="50" />
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
