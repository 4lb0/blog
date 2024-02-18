<?php

namespace Blog;

use DateTime;

class Posts
{
    const PATH = __DIR__ . '/../pages/%s.md';
    const AVERAGE_SPEED_READING = 180;
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
        $date = new DateTime($markdown['date']);
        $date->setTime(0, 0, 0);
        $markdown['date'] = $date->getTimestamp();
        if ($markdown['last_update']) {
            $lastUpdate = new DateTime($markdown['last_update']);
            $lastUpdate->setTime(0, 0, 0);
            $markdown['last_update'] = $lastUpdate->getTimestamp();
        }
        $markdown['readingTime'] = ceil(str_word_count($content) / static::AVERAGE_SPEED_READING);
        return $markdown;
    }

    static private function _list(string $tag): array
    {
        if (static::$list) {
            return static::$list;
        }
        $posts = [];
        $files = glob(sprintf(static::PATH, '*'));
        $today = new DateTime();
        $today->setTime(0, 0, 0);
        foreach ($files as $markdownFile) {
            $markdown = static::_get($markdownFile);
            // Don't publish future posts
            if ($today->getTimestamp() <= $markdown['date']) {
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
            $tag = $post['tags'][0];
            $tag = link_tag($tag);
            if (!isset($tags[$tag])) {
                $tags[$tag] = [];
            }
            $tags[$tag][] = $post;
        }
        return $tags;
    }
}
