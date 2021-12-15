# 💡 albo.ar

Another static generated blog with Markdown. This time with PHP.

[![Status](https://github.com/4lb0/blog/actions/workflows/build.yml/badge.svg)](https://github.com/4lb0/blog/actions/workflows/build.yml)

To run locally:

```
BLOG_AUTHOR=Author \
BLOG_TITLE=Title \
php -S 127.0.0.1:8000 -t public app.php
```

To generate the static content:

```
php build.php
```
