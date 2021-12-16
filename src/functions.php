<?php

$sitemap = [];

function render(string $template, array $vars = [])
{
    extract($vars);
    ob_start();
    include __DIR__ . "/../templates/$template.php";
    $html = ob_get_clean();
    $parser = \WyriHaximus\HtmlCompress\Factory::constructSmallest();
    return $parser->compress($html);
}

function write($name, $template, $vars)
{
    global $sitemap;
    $file = "/$name.html";
    $sitemap[] = [
        'loc' => $name != 'index' ? BLOG_URL . $file : BLOG_URL,
        'lastmod' => date('Y-m-d', $vars['last_update'] ?? $vars['date']),
    ];
    $path = __DIR__ . '/../public';
    $content = render($template, $vars);
    echo "Writing $name from template $template\n";
    file_put_contents($path . $file, $content);
}

function print_date($date): string
{
    return strftime('%A %e de %B del %G', $date);
}

function sitemap()
{
    global $sitemap;
    $xml = simplexml_load_string(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
</urlset>
XML);
    foreach ($sitemap as $site) {
        $url = $xml->addChild('url');
        foreach ($site as $key => $value) {
            $url->addChild($key, $value);
        }
    }
    echo "Writing sitemap\n";
    file_put_contents(__DIR__ . '/../public/sitemap.xml', $xml->asXML());
}

function get_date_from_list(array $posts): int 
{
    $last = 0;
    foreach ($posts as $post) {
        $date = $post['last_update'] ?? $post['date'];
        if ($date > $last) {
            $last = $date;
        }
    }
    return $last;
}
