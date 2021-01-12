<?php
declare(strict_types=1);

namespace App\Entity;

class Post
{
    public string $title;
    public string $excerpt;
    public string $content;
    public int $datetime;
    public string $slug;
}
