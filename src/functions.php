<?php

$sitemap = [];

function render(string $template, array $vars = [])
{
    extract($vars);
    ob_start();
    include __DIR__ . "/../templates/$template.php";
    $html = ob_get_clean();
    $html = replace_images($html);
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
    return @strftime('%A %e de %B del %G', $date);
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

function robotsTxt()
{
    $url = BLOG_URL;
    file_put_contents(
        __DIR__ . '/../public/robots.txt',
        "User-agent: *\nAllow: /\nSitemap: $url/sitemap.xml"
    );
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

function replace_images($html) {
    if (preg_match_all('/<img src="([^"]+)"/', $html, $matches)) {
        foreach ($matches[1] as $match) {
            $file = dirname(__DIR__) . '/assets/' . $match;
            $image = file_get_contents($file);
            $type = get_image_type($match);
            $encodedImage = base64_encode($image);
            $html = str_replace($match, "data:$type;base64,$encodedImage", $html);
        }
    }
    return $html;
}

function get_image_type($image) {
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    switch ($extension) {
    case 'svg':
        return 'image/svg+xml';
    case 'jpg':
        $extension = 'jpeg';
        break;

    }
    return "image/$extension";
}

function link_tag($tag) {
    return str_replace(' ', '-', strtolower($tag));
}

function remove_new_lines($text) {
    return trim(preg_replace('/\s+/', ' ', $text));
}

function rss(array $posts)
{
    $title = htmlspecialchars(BLOG_TITLE);
    $url = BLOG_URL;
    $description = htmlspecialchars('Blog de ' . BLOG_AUTHOR);
    $lastBuildDate = gmdate('r', $posts[array_key_first($posts)]['date'] ?? time());
    
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
    $xml .= '<channel>' . "\n";
    $xml .= "  <title>$title</title>\n";
    $xml .= "  <link>$url</link>\n";
    $xml .= "  <description>$description</description>\n";
    $xml .= "  <language>es</language>\n";
    $xml .= "  <lastBuildDate>$lastBuildDate</lastBuildDate>\n";
    $xml .= "  <atom:link href=\"$url/rss.xml\" rel=\"self\" type=\"application/rss+xml\" />\n";
    
    foreach ($posts as $post) {
        $postTitle = htmlspecialchars($post['title']);
        $postUrl = "$url/{$post['url']}";
        $postDesc = htmlspecialchars(strip_tags($post['description']));
        $postDate = gmdate('r', $post['date']);
        
        $xml .= '  <item>' . "\n";
        $xml .= "    <title>$postTitle</title>\n";
        $xml .= "    <link>$postUrl</link>\n";
        $xml .= "    <description>$postDesc</description>\n";
        $xml .= "    <pubDate>$postDate</pubDate>\n";
        $xml .= "    <guid>$postUrl</guid>\n";
        $xml .= '  </item>' . "\n";
    }
    
    $xml .= '</channel>' . "\n";
    $xml .= '</rss>';
    
    echo "Writing rss.xml\n";
    file_put_contents(__DIR__ . '/../public/rss.xml', $xml);
}
