<?php

namespace Blog;

class Render
{
    public function post($markdownFile)
    {
        $content = file_get_contents(__DIR__ . "/../pages/$markdownFile.md");
        $markdown = (new Markdown())($content);
        return $this->__invoke($markdown['template'], $markdown);
    }

    public function tag(array $posts)
    {
    }

    public function __invoke(string $template, array $vars = [])
    {
        extract($vars);
        ob_start();
        include __DIR__ . "/../templates/$template.php";
        return ob_get_clean();
    }
}
