<?php

$startYear = 2006;
$totalYears = date('Y') - $startYear;
$description = <<<EOD
Hace {$totalYears} años que me pagan por resolver problemas con código.
Socio de <a href=https://caallboys.com.ar>All Boys</a>.
Tengo muchos hijos, entre ellos <a href=//pragmore.com>Pragmore</a>.
Decime <strong>Albo</strong>.
EOD;
?>
<?php include 'header.php'; ?>
<main>
    <h1>
        <?= $_ENV['BLOG_TITLE'] ?>
    </h1>
    <p>
        <em><?= $description ?></em>
    </p>
<?php foreach($posts as $post): ?>
    <h2><a href="<?= $post['url'] ?>"><?= $post['title'] ?></a></h2>
    <?php extract($post); ?>
    <?php include '_post.php'; ?>
<?php endforeach; ?>
</main>
<?php include 'footer.php'; ?>
