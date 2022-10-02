<?php $description = "Blog de programación, tecnología, devops y tal vez hasta UX"; ?>
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
