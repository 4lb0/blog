<?php
declare(strict_types=1);

namespace App\Component;

use Fernet\Params;
use App\Entity\Post;

class PostRow
{
    public Post $post;
    public string $type = 'content';

    private ShowPost $showPost;

    
    public function __construct(ShowPost $showPost)
    {
        $this->showPost = $showPost;
    }
    
    public function handleViewPost(string $postSlug): void
    {
        $this->showPost->show($postSlug);
    }

    private function addLinkToH1(string $link, string $content): string
    {
        return \str_replace(
            ['<h1>', '</h1>'],
            ["<h1>{$link}", '</a></h1>'],
            $content
        );
    }

    public function __toString(): string
    {
        $link = '<a @onClick="handleViewPost(' . Params::event(['postSlug' => $this->post->slug]) . ')">';
        $content = $this->addLinkToH1($link, $this->post->{$this->type});
        \ob_start(); ?>
            <div class="post">
                <PostDate timestamp="<?= $this->post->datetime ?>" />
                <?= $content ?>
                <?php if ($this->type == 'excerpt'): ?>
                <p><?= $link?>Read more ⭢</a></p>
                <?php endif ; ?>
            </div><?php 
        return \ob_get_clean();
    }
}
