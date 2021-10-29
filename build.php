<?php

require __DIR__ . '/vendor/autoload.php';

use Blog\Posts;

setlocale(LC_ALL, 'es_AR.UTF-8');

$posts = Posts::list();
$tags = [];

write('index', 'home', ['posts' => $posts]);

foreach ($posts as $post) {
    foreach ($post['tags'] as $tag) {
        if (!isset($tags[$tag])) {
            $tags[$tag] = [];
        }
        $tags[$tag][] = $post;
    }
    write($post['file'], $post['template'], $post);
}

foreach ($tags as $tag  => $posts) {
    write("tag-$tag", 'tags', ['posts' => $posts, 'tag' => $tag]);
}
