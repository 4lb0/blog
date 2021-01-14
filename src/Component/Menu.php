<?php
declare(strict_types=1);

namespace App\Component;

class Menu 
{
    private App $app;
    private ?string $twitter;
    private ?string $github;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->twitter = $_ENV['APP_TWITTER'] ?? null;
        $this->github = $_ENV['APP_GITHUB'] ?? null;
    }

    public function handleAbout(): void
    {
        $this->app->about();
    }

    public function __toString(): string
    {
        \ob_start(); ?>
            <p class="center">
                <a href="/">Blog</a>
                ∣ <a @onClick="handleAbout">About me</a>
                <?php if ($this->twitter): ?>
                    ∣ <ExternalLink href="<?= $this->twitter ?>">Twitter</ExternalLink>
                <?php endif; ?>
                <?php if ($this->github): ?>
                    ∣ <ExternalLink href="<?= $this->github ?>">Github</ExternalLink>
                <?php endif; ?>
            </p><?php 
        return \ob_get_clean();
    }
}

