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

    public function show(string $postSlug): void
    {
        $this->post = $this->postService->find($postSlug);
        $this->app->setTitle($this->post->title);
    }

    public function __toString(): string
    {
        \ob_start(); ?>

            <?php if ($this->post): ?>
                <PostRow <?= Params::component(['post' => $this->post]) ?> />
            <?php else: ?>
                <?php foreach ($this->postService->list() as $post): ?> 
                    <PostRow type="excerpt" <?= Params::component(['post' => $post]) ?> />
                <?php endforeach; ?>
            <?php endif; ?>

<?php
        return \ob_get_clean();
    }
}

