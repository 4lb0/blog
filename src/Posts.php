<?php

namespace Blog;

class Posts
{
    const PATH = __DIR__ . '/../pages/%s.md';
    static private $list = [];

    static public function list(): array
    {
        return static::_list('');
    }

    static public function listByTag(string $tag): array
    {
        return static::_list($tag);
    }

    static public function get(string $file): array
    {
        return static::_get(sprintf(static::PATH, $file));
    }

    static private function _get(string $file): array
    {
        $content = file_get_contents($file);
        $markdown = (new Markdown())($content);
        $markdown['file'] = basename($file, '.md');
        $markdown['url'] = $markdown['file'] . '.html';
        return $markdown;
    }

    static private function _list(string $tag): array
    {
        if (static::$list) {
            return static::$list;
        }
        $posts = [];
        $files = glob(sprintf(static::PATH, '*'));
        foreach ($files as $markdownFile) {
            $markdown = static::_get($markdownFile);
            if ($markdown['wip'] ?? false) {
                continue;
            }
            $tags = array_map('link_tag', $markdown['tags']); 
            if (!$tag || in_array($tag, $tags)) {
                $posts[$markdown['date'] . $markdown['file']] = $markdown;
            }
        }
        krsort($posts);
        static::$list = $posts;
        return $posts;
    }

    static public function exists(string $post): bool
    {
        return file_exists(sprintf(static::PATH, $post));
    }

    static public function tags(): array
    {
        $tags = [];
        foreach (static::list() as $post) {
            foreach ($post['tags'] as $tag) {
                $tag = link_tag($tag);
                if (!isset($tags[$tag])) {
                    $tags[$tag] = [];
                }
                $tags[$tag][] = $post;
            }
        }
        var_dump($tags);
        return $tags;
    }
}
