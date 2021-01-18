<?php

namespace App;

use Fernet\Framework;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

class Bootstrap extends PluginBootstrap
{
    public function setUp(Framework $framework): void
    {
        $languages = ['html', 'php', 'js'];
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer($languages));
        $environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer($languages));
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $commonMarkConverter = new CommonMarkConverter([], $environment);
        $framework->getContainer()->add(CommonMarkConverter::class, fn() => $commonMarkConverter);
    }

}
