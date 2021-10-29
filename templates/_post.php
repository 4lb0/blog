    <p class="text-center mt-2 mute">
        Publicado por <a href="."><?= $author ?? getenv('BLOG_AUTHOR') ?></a> el <?= strftime('%A %e de %B del %G', $date) ?>.
        <?php if (count($tags)): ?>
            Tags:
            <?php foreach ($tags as $i => $tag): ?> 
                <a href="tag-<?= $tag ?>.html"><?= $tag ?></a><?php if($i !== count($tags) - 1): ?>, <?php endif; ?>
            <?php endforeach; ?>.
        <?php endif; ?>
    </p>
