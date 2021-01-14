<?php
declare(strict_types=1);

namespace App\Component;

class Menu 
{
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function handleAbout(): void
    {
        $this->app->about();
    }

    public function __toString(): string
    {
        \ob_start(); ?>
            <p class="center">
                <a href="/">Home</a>
                ∣ <a @onClick="handleAbout">About me</a>
                <?php if (isset($_ENV['TWITTER'])): ?>
                    ∣ <ExternalLink href="<?= $_ENV['TWITTER'] ?>">Twitter</ExternalLink>
                <?php endif; ?>
                <?php if (isset($_ENV['GITHUB'])): ?>
                    ∣ <ExternalLink href="<?= $_ENV['GITHUB'] ?>">Github</ExternalLink>
                <?php endif; ?>
            </p><?php 
        return \ob_get_clean();
    }
}

