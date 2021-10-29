<?php

function render(string $template, array $vars = [])
{
    extract($vars);
    ob_start();
    include __DIR__ . "/../templates/$template.php";
    return ob_get_clean();
}

function write($name, $template, $vars)
{
    $path = __DIR__ . '/../public';
    $content = render($template, $vars);
    echo "Writing $name from template $template\n";
    file_put_contents("$path/$name.html", $content);
}
