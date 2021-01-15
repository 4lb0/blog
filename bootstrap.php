<?php

declare(strict_types=1);
require __DIR__.'/vendor/autoload.php';

session_start();

Dotenv\Dotenv::createImmutable(__DIR__)->load();
Fernet\Framework::setUp([
    'rootPath' => __DIR__,
]);

use Fernet\Framework;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

Framework::subscribe('onLoad', function (Framework $framework) {
    $languages = ['html', 'php', 'js'];
    $environment = Environment::createCommonMarkEnvironment();
    $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer($languages));
    $environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer($languages));
    $environment->addExtension(new GithubFlavoredMarkdownExtension());
    $commonMarkConverter = new CommonMarkConverter([], $environment);
    $framework->getContainer()->add(CommonMarkConverter::class, fn() => $commonMarkConverter);
});
