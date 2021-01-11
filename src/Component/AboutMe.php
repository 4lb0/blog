<?php
declare(strict_types=1);

namespace App\Component;

use Fernet\Framework;

class AboutMe 
{
    public function __toString(): string
    {
        return <<<EOH
            <h1>About me</h1>
            <p>
                Hey, my name is Rodrigo but I prefer to be called <em>Albo</em>.
                I've beeing programming for the last 15+ years.
            </p>
            <p>
                This is a minimalist blog written with <a href="https://github.com/pragmore/fernet">Fernet</a>.
                Yes, another boring markdown blog.
                You can still see the full code <a href="https://github.com/4lb0/blog">here</a>.
            </p>
EOH;
    }
}

