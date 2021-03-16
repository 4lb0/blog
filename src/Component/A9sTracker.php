<?php

declare(strict_types=1);

namespace App\Component;

class A9sTracker
{
    public bool $preventWrapper = true;

    public function __toString(): string
    {
        return "<script>(function(d){s=d.createElement('script');s.src='https://a9s.uno/t.js?w='+window.innerWidth;d.body.append(s)})(document)</script>";
    }
}

