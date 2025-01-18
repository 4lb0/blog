<?php

namespace Blog;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;

class Markdown
{
    const CONFIG = [
        'html_input' => 'allow',
        'external_link' => [
            'open_in_new_window' => true,
            'html_class' => 'external-link',
            'nofollow' => '',
            'noopener' => 'external',
            'noreferrer' => 'external',
        ],
    ];

    private function getDefaultAttributes(): array
    {
        return [
            'author' => BLOG_AUTHOR,
            'last_update' => null,
        ];

    }

    public function __invoke($content)
    {
        $environment = new Environment(static::CONFIG);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());
        $environment->addExtension(new ExternalLinkExtension());
        $converter = new MarkdownConverter($environment);
        $markdown = $converter->convertToHtml($content);
        if ($markdown instanceof RenderedContentWithFrontMatter) {
            $attributes = $markdown->getFrontMatter() + $this->getDefaultAttributes();
        }
        $attributes['post'] = (string) $markdown;
        return $attributes;
    }
}
