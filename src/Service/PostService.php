<?php 
declare(strict_types=1);

namespace App\Service;

use App\Entity\Post;
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

    public function parseFile($file): Post 
    {
        $content = \file_get_contents($file);
        list($excerpt, $other) = explode(static::MORE, $content);
        $post = new Post;
        $post->title = trim(str_replace('#', '', strtok($content, "\n")));
        $post->excerpt = $this->markdown->text($excerpt);
        $post->slug = \basename($file, '.md');
        $post->datetime = \filemtime($file);
        $post->content = $this->markdown->text($excerpt . $other);
        return $post;
    }

    public function list(): array
    {
        $posts = [];
        foreach (\glob($this->filename('*')) as $file) {
            $post = $this->parseFile($file);
            $posts[$post->datetime . $post->slug] = $post;
        }
        \krsort($posts);
        return $posts;
    }

    public function find(string $slug): Post 
    {
        $filename = $this->filename($slug);
        if (\file_exists($filename)) {
            return $this->parseFile($filename);
        }
        throw new NotFoundException;
    }
}
