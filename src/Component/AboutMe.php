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
            <p class="center">
                <img  src="/img/allboys.png" alt="All Boys logo" />
            </p>
            <p>
                Hey, my name is Rodrigo but I prefer to be called <strong>Albo</strong> (<ExternalLink href="https://en.wikipedia.org/wiki/All_Boys">All Boys</ExternalLink>' nickname).
                I've beeing getting paid for developing web apps for the last 15+ years, mostly in PHP and JS.
            </p>
            <p>I'm a father of 3 boys and a husband. In 2010 I co-found <ExternalLink href="https://pragmore.com">Pragmore</ExternalLink>.</p>
            <p>
                This is minimalist blog written with <ExternalLink href="https://github.com/pragmore/fernet">Fernet</ExternalLink> (because <ExternalLink href="https://edume.com/blog/what-is-dogfooding">dogfooding</ExternalLink> is good).
                You can see the <ExternalLink href="https://github.com/4lb0/blog">full code in GitHub</ExternalLink>.
            </p>
EOH;
    }
}

