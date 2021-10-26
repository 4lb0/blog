<?php

namespace Blog;

class DevServer 
{
    const TITLE = 'albo.ar';
    const LOGO = '💡';
    const TAGS_PREFIX = 'tag-';
    const IMAGES_URL = '/images';

    public function __invoke()
    {
        $url = pathinfo($_SERVER['REQUEST_URI']);
        $render = new Render();
        if ($url['filename'] === '') {
            echo $render('home', ['posts' => (new Posts)()]);
        } elseif ($url['dirname'] === static::IMAGES_URL) {
            echo file_get_contents(__DIR__ . '/../public' . $_SERVER['REQUEST_URI']);
        } elseif (substr($url['filename'], 0, strlen(static::TAGS_PREFIX)) === static::TAGS_PREFIX) {
            $tag = substr($url['filename'], strlen(static::TAGS_PREFIX));
            $posts = (new Posts)($tag);
            echo $render('tags', ['posts' => $posts, 'tag' => $tag]);
        } else {
            echo $render->post($url['filename']);
        }
    }
}
