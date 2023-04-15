<?php $description = "Hace 18 años que me pagan por resolver problemas con código. Socio de All Boys. Tengo muchos hijos, entre ellos <a href=//pragmore.com>Pragmore</a>. Decime Albo."; ?>
<?php include 'header.php'; ?>
<main>
    <h1>
        <?= $_ENV['BLOG_TITLE'] ?>
    </h1>
    <p><?= $description ?></p>
<?php foreach($posts as $post): ?>
    <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
    <?php extract($post); ?>
    <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>
