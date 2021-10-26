<?php

namespace Blog;

class Posts
{
    public function __invoke(?string $tag = null)
    {
        $posts = [];
        $files = glob(__DIR__ . "/../pages/*.md");
        foreach ($files as $markdownFile) {
            $content = file_get_contents($markdownFile);
            $markdown = (new Markdown())($content);
            $markdown['file'] = basename($markdownFile, '.md');
            if (!$tag || in_array($tag, $markdown['tags'])) {
                $markdown['url'] = '/' . $markdown['file'] . '.html';
                $posts[$markdown['date']] = $markdown;
            }
        }
        krsort($posts);
        return $posts;
    }
}
