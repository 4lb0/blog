<?php 
declare(strict_types=1);

namespace App\Service;

use Parsedown;
use Fernet\Core\NotFoundException;

class PostService
{
    private const FILES = __DIR__ . '/../../posts/%s.md';
    private const MORE = '----';
    private Parsedown $markdown;

    public function __construct(Parsedown $markdown)
    {
        $this->markdown = $markdown;
    }

    public function filename(string $filename): string
    {
        return sprintf(static::FILES, $filename);
    }

    public function parseFile($file): object
    {
        $content = \file_get_contents($file);
        list($excerpt, $other) = explode(static::MORE, $content);
        return (object) [
            'title' => trim(str_replace('#', '', strtok($content, "\n"))),
            'excerpt' => $this->markdown->text($excerpt),
            'slug' => \basename($file, '.md'),
            'datetime' => \filemtime($file),
            'content' => $this->markdown->text($excerpt . $other),
        ];
    }

    public function list(): array
    {
        $posts = [];
        foreach (\glob($this->filename('*')) as $file) {
            $post = $this->parseFile($file);
            $posts[$post->datetime] = $post;
        }
        \krsort($posts, SORT_NUMERIC);
        return $posts;
    }

    public function find(string $slug): object 
    {
        $filename = $this->filename($slug);
        if (\file_exists($filename)) {
            return $this->parseFile($filename);
        }
        throw new NotFoundException;
    }
}
