<?php
declare(strict_types=1);

namespace App\Component;

use Fernet\Params;
use App\Service\PostService;

class Post 
{
    private PostService $postService;
    private App $app;
    private $post;

    public function __construct(PostService $postService, App $app)
    {
        $this->postService = $postService;
        $this->app = $app;
    }

    public function show($postSlug): void
    {
        $this->post = $this->postService->find($postSlug);
        $this->app->setTitle($this->post->title);
    }

    public function __toString(): string
    {
        if ($this->post) {
            $params = Params::component(['post' => $this->post]);
            return "<PostRow {$params} />";
        }

        $posts = $this->postService->list();
        $contents = [];
        foreach ($posts as $post) { 
            $params = Params::component(['post' => $post]);
            $contents[] = "<PostRow {$params} type='excerpt' />";
        }

        return implode("\n", $contents);
    }
}

