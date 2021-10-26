    <p>
        Publicado el <?= strftime('%A %e de %B del %G', $date) ?>.
        Tags:
        <?php foreach ($tags as $i => $tag): ?> 
            <a href="/tag/<?= $tag ?>.html"><?= $tag ?></a><?php if($i !== count($tags) - 1): ?>, <?php endif; ?>
        <?php endforeach; ?>
    </p>
