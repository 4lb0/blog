<!doctype html>
<html lang="es">
<head>
  <title><?= (isset($title) ? "$title - " : "") . \Blog\DevServer::TITLE ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22><?= \Blog\DevServer::LOGO ?></text></svg>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/4lb0/blouse.css@latest/dist/blouse.css" media="screen" crossorigin="anonymous">
  <style>
    @font-face {
      font-family: 'Literata';
      font-style: normal;
      font-weight: 400;
      font-display: swap;
      src: url(https://fonts.gstatic.com/s/literata/v23/or3PQ6P12-iJxAIgLa78DkrbXsDgk0oVDaDPYLanFLHpPf2TbBG_J_HWTA.woff2) format('woff2');
      unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
    body { font-family: 'Literata', serif }
    article { margin-bottom: 4em }
  </style>
</head>
<body>
