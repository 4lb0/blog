<!doctype html>
<html lang="es">
<head>
  <title><?= isset($title) ? "$title - " : "" . \Blog\DevServer::TITLE ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22><?= \Blog\DevServer::LOGO ?></text></svg>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/4lb0/blouse.css@latest/dist/blouse.css" crossorigin="anonymous">
<style>
@import url('https://fonts.googleapis.com/css2?family=Literata&display=swap');
body {
    font-family: 'Literata', serif;
}
</style>
</head>
<body>
