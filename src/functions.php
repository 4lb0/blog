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
    return preg_replace_callback('/<img\b[^>]*>/i', 'process_image', $html);
}

/**
 * Inlines a local <img> and adds the hints that keep the page from shifting.
 * SVGs are percent-encoded instead of base64: base64 is incompressible, so the
 * same file costs about a third more bytes on the wire.
 */
function process_image(array $match): string {
    $tag = $match[0];

    if (!preg_match('/\bsrc\s*=\s*(["\'])(.*?)\1/i', $tag, $src)) {
        return $tag;
    }

    $path = $src[2];
    if (preg_match('#^(?:[a-z][a-z0-9+.-]*:)?//#i', $path) || str_starts_with($path, 'data:')) {
        return $tag;
    }

    $file = dirname(__DIR__) . '/assets/' . $path;
    if (!is_file($file)) {
        return $tag;
    }

    $type = get_image_type($path);
    if ($type === 'image/svg+xml') {
        $uri = "data:$type," . encode_svg($file);
    } else {
        $uri = "data:$type;base64," . base64_encode(file_get_contents($file));
    }

    $tag = preg_replace_callback(
        '/\bsrc\s*=\s*(["\']).*?\1/i',
        fn() => "src=\"$uri\"",
        $tag,
        1
    );

    return add_size_attributes($tag, image_size($file, $type));
}

function encode_svg(string $file): string {
    $svg = file_get_contents($file);
    $svg = preg_replace('/<\?xml.*?\?>/s', '', $svg);
    $svg = preg_replace('/<!DOCTYPE.*?>/is', '', $svg);
    $svg = preg_replace('/<!--.*?-->/s', '', $svg);
    $svg = trim(preg_replace('/\s+/', ' ', $svg));

    return strtr(rawurlencode($svg), [
        '!' => '%21', "'" => '%27', '(' => '%28', ')' => '%29', '*' => '%2A',
    ]);
}

function image_size(string $file, string $type): ?array {
    if ($type === 'image/svg+xml') {
        $svg = file_get_contents($file);
        // The declared width/height is the intended size; viewBox is the fallback.
        if (preg_match('/\bwidth\s*=\s*(["\'])([\d.]+)[^>]*?\bheight\s*=\s*(["\'])([\d.]+)\3/i', $svg, $m)) {
            return [(int) round($m[2]), (int) round($m[4])];
        }
        if (preg_match('/viewBox\s*=\s*(["\'])\s*[-\d.]+[\s,]+[-\d.]+[\s,]+([\d.]+)[\s,]+([\d.]+)\s*\1/i', $svg, $m)) {
            return [(int) round($m[2]), (int) round($m[3])];
        }
        return null;
    }

    $size = @getimagesize($file);
    return $size ? [$size[0], $size[1]] : null;
}

function add_size_attributes(string $tag, ?array $size): string {
    if ($size) {
        foreach (['width', 'height'] as $i => $attribute) {
            if (!preg_match('/\b' . $attribute . '\s*=/i', $tag)) {
                $tag = add_attribute($tag, $attribute, $size[$i]);
            }
        }
    }
    if (!preg_match('/\bloading\s*=/i', $tag)) {
        $tag = add_attribute($tag, 'loading', 'lazy');
    }
    if (!preg_match('/\bdecoding\s*=/i', $tag)) {
        $tag = add_attribute($tag, 'decoding', 'async');
    }
    return $tag;
}

function add_attribute(string $tag, string $name, $value): string {
    return preg_replace('/\s*\/?>$/', " $name=\"$value\">", $tag, 1);
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
