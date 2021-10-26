<?php

namespace Blog;

class DevServer 
{
    const AUTHOR = 'Albo';
    const TITLE = 'albo.ar';
    const LOGO = '💡';
    const TAGS_PREFIX = 'tag-';

    public function __invoke()
    {
        $url = pathinfo($_SERVER['REQUEST_URI']);
        $render = new Render();
        $staticFile = __DIR__ . '/../public' . $_SERVER['REQUEST_URI'];
        if (file_exists($staticFile) && is_file($staticFile)) {
            echo file_get_contents($staticFile);
        } elseif ($url['filename'] === '') {
            echo $render('home', ['posts' => (new Posts)()]);
        } elseif (substr($url['filename'], 0, strlen(static::TAGS_PREFIX)) === static::TAGS_PREFIX) {
            $tag = substr($url['filename'], strlen(static::TAGS_PREFIX));
            $posts = (new Posts)($tag);
            echo $render('tags', ['posts' => $posts, 'tag' => $tag]);
        } elseif (file_exists(__DIR__ . '/../pages/' . $url['filename'] . '.md')) {
            echo $render->post($url['filename']);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo '<html><body>404 Not Found</body></html>';
        }
    }
}
