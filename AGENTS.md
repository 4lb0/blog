# AGENTS.md - Project Architecture & Build System

## Overview

This is a **static site generator blog** built with PHP. It converts Markdown posts into static HTML files that are deployed to `blog.albo.ar`.

## Architecture

```
blog/
├── pages/              # Markdown source files (posts)
├── templates/          # PHP templates for rendering
├── src/                # Core PHP classes and functions
│   ├── Markdown.php    # Markdown parser with frontmatter
│   ├── Posts.php       # Post repository class
│   ├── functions.php   # Helper functions
│   └── u.css           # Inline CSS (embedded in HTML)
├── assets/             # Images referenced in posts
├── public/             # Generated static site (output)
├── build.php           # Static site generator script
└── app.php             # Development server router
```

## How It Works

### 1. Markdown Processing

Posts are written in Markdown with YAML frontmatter. The `Markdown` class uses:
- **League/CommonMark** for parsing
- **FrontMatterExtension** to extract metadata
- **ExternalLinkExtension** to auto-add `target="_blank"` to external links

Frontmatter fields:
```yaml
---
title: Post Title
tags: [Tag1, Tag2]
date: YYYY-MM-DD
template: post
description: Brief description
illustration: undraw   # Optional: adds unDraw illustration
---
```

### 2. The Posts Class

`src/Posts.php` - Repository pattern for accessing posts:

- **`list()`**: Returns all posts sorted by date (newest first)
- **`get($file)`**: Returns a single post by filename
- **`exists($post)`**: Checks if a post exists
- **`tags()`**: Groups posts by first tag for tag pages
- **Reading time**: Calculated as `word_count / 180 WPM`

Posts are cached in memory during a single request.

### 3. Template System

Templates are plain PHP files in `templates/`:

- **`header.php`** / **`footer.php`**: Layout wrapper
- **`home.php`**: Blog index (list of posts)
- **`post.php`**: Individual post page
- **`tags.php`**: Tag listing page
- **`_post.php`**: Post preview snippet (used on home)

**Rendering flow:**
1. `render($template, $vars)` extracts variables and includes the PHP template
2. `replace_images()` converts local image refs to base64 data URIs
3. HTML is minified using `WyriHaximus/HtmlCompress`

### 4. unDraw Illustrations

In `templates/post.php` (lines 17-18), if `illustration: undraw` is set in frontmatter:

```php
<?php if (isset($illustration) && $illustration): ?>
    <img src="<?= $illustration ?>.svg" alt="" />
```

This loads `undraw.svg` from assets. The template also adds attribution:
> "La Ilustración es de Katerina Limpitsouni publicada en unDraw"

### 5. Image Handling

Images in `assets/` are **inlined as base64** during build:

```php
// From functions.php
function replace_images($html) {
    // Finds <img src="filename.jpg"> 
    // Replaces with <img src="data:image/jpeg;base64,...">
}
```

Supported formats: SVG, JPEG, PNG

### 6. Static Site Generation

`build.php` generates the entire site:

```php
// 1. Generate index (home page)
write('index', 'home', ['posts' => Posts::list()]);

// 2. Generate each post
foreach (Posts::list() as $post) {
    write($post['file'], $post['template'], $post);
}

// 3. Generate tag pages
foreach (Posts::tags() as $tag => $posts) {
    write("tag-$url", 'tags', ['posts' => $posts, 'tag' => $tag]);
}

// 4. Generate sitemap.xml and robots.txt
sitemap();
robotsTxt();
```

Output goes to `public/` as flat HTML files.

### 7. Development Server

`app.php` is the router for `php -S`:

```bash
php -S 127.0.0.1:8000 -t public app.php
```

It handles:
- `/` → Renders home template
- `/tag-{name}` → Renders tag template  
- `/{post}` → Renders post template
- Static files → Returns directly if exists
- 404 → Simple error page

### 8. Configuration

Environment variables (loaded from `.env`):

| Variable | Default | Purpose |
|----------|---------|---------|
| `BLOG_TITLE` | "My Blog" | Site title |
| `BLOG_AUTHOR` | "Anonymous" | Default author |
| `BLOG_URL` | "http://localhost:8000" | Canonical URL |
| `BLOG_LOGO` | "💡" | Emoji favicon |

## Build Commands

```bash
# Development server
php -S 127.0.0.1:8000 -t public app.php

# Generate static site
php build.php

# Install dependencies
composer install
```

## Deployment

GitHub Actions workflow (`.github/workflows/build.yml`):

1. Checkout repository
2. Setup PHP 8.1
3. `composer install`
4. `php build.php` → Generates `public/`
5. Deploy `public/` to `static-pages` branch
6. GitHub Pages serves `blog.albo.ar` (CNAME configured)

## Key Dependencies

| Package | Purpose |
|---------|---------|
| `league/commonmark` | Markdown parsing |
| `vlucas/phpdotenv` | Environment variables |
| `wyrihaximus/html-compress` | HTML minification |

## Notes

- Posts are sorted by date descending (newest first)
- Tag pages use the **first tag** only for grouping
- Reading time is calculated at build time
- All dates are stored as Unix timestamps internally
- Spanish locale (`es_AR.UTF-8`) is set for date formatting
