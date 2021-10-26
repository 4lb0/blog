<?php

require __DIR__ . '/vendor/autoload.php';

use Blog\Posts;
use Blog\Render;

setlocale(LC_ALL, 'es_AR.UTF-8');

function write($name, $template, $vars)
{
    $path = __DIR__ . '/public';
    $render = new Render();
    $content = $render($template, $vars);
    echo "Writing $name from template $template\n";
    file_put_contents("$path/$name.html", $content);
}

$posts = (new Posts)();
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
    write("tag/$tag", 'tags', ['posts' => $posts, 'tag' => $tag]);
}
