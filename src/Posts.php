<?php

namespace Blog;

class Posts
{
    const PATH = __DIR__ . '/../pages/%s.md';

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
        $posts = [];
        $files = glob(sprintf(static::PATH, '*'));
        foreach ($files as $markdownFile) {
            $markdown = static::_get($markdownFile);
            if (!$tag || in_array($tag, $markdown['tags'])) {
                $posts[$markdown['date'] . $markdown['file']] = $markdown;
            }
        }
        krsort($posts);
        return $posts;
    }

    static public function exists(string $post): bool
    {
        return file_exists(sprintf(static::PATH, $post));
    }
}
