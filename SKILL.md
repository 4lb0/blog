# AGENTS.md - Guía para crear posts

Este archivo contiene las instrucciones para crear nuevos posts en el blog.

## Estructura del proyecto

```
blog/
├── pages/           # Posts en Markdown (uno por archivo)
├── src/
│   └── template-post.md   # Plantilla base para nuevos posts
├── public/          # Sitio generado (no editar manualmente)
├── templates/       # Templates PHP para renderizado
├── build.php        # Script para generar el sitio estático
└── app.php          # Entry point para servidor de desarrollo
```

## URL del blog

Cuando se hace push a este repositorio, el sitio se publica automáticamente en:
**https://blog.albo.ar**

## Cómo crear un nuevo post

### 1. Crear el archivo

Copiar la plantilla base al directorio `pages/` con el nombre deseado para la
URL:

```bash
cp src/template-post.md pages/mi-nuevo-post.md
```

> **Nota:** El nombre del archivo (sin `.md`) será la URL del post. Ejemplo:
> `pages/vim-no-vale-la-pena.md` → `https://blog.albo.ar/vim-no-vale-la-pena`

### 2. Editar el frontmatter

El archivo debe comenzar con el siguiente bloque YAML:

```yaml
---
title: Título del post
tags:
  - Tag1
  - Tag2
date: YYYY-MM-DD
template: post
description: Breve descripción del post (para SEO y previews)
illustration: going_up # Opcional: nombre de ilustración en assets/

---
```

**Campos obligatorios:**

- `title`: Título del post
- `tags`: Lista de etiquetas (al menos una recomendada)
- `date`: Fecha en formato ISO (YYYY-MM-DD)
- `template`: Siempre `post`
- `description`: Descripción corta para SEO

**Campos opcionales:**

- `illustration`: Nombre del archivo SVG en `assets/` (sin extensión).
  Descargar de [unDraw](https://undraw.co/illustrations). Puede omitirse.

### 3. Escribir el contenido

Debajo del frontmatter, escribir el contenido en **Markdown**. Ejemplo:

```markdown
## Introducción

Este es el párrafo introductorio.

## Sección principal

- Item 1
- Item 2

[Link de ejemplo](https://ejemplo.com)
```

### 4. Verificar localmente (opcional)

```bash
# Iniciar servidor de desarrollo
php -S 127.0.0.1:8000 -t public app.php

# Generar sitio estático
php build.php
```

### 5. Publicar

Hacer commit y push. GitHub Actions se encarga de:

1. Generar el sitio estático con `php build.php`
2. Desplegar automáticamente a `blog.albo.ar`

## Ejemplo completo

```markdown
---
title: Mi nuevo artículo
tags:
  - PHP
  - Web
date: 2024-01-15
template: post
description: Aprendiendo a crear posts en el blog
---

## Introducción

Este es mi nuevo artículo sobre PHP.

## Conclusión

¡Es muy fácil crear posts!
```

## Convenciones

- **URLs amigables:** Usar nombres descriptivos en español, separados por
  guiones
  - ✅ `pages/como-usar-git.md`
  - ❌ `pages/post1.md`
- **Tags:** Usar categorías relevantes y consistentes (revisar tags existentes)

- **Fechas:** Usar la fecha real de publicación

- **Imágenes:** Si se incluyen, usar rutas relativas y guardarlas en `assets/`
- **Ilustraciones:** Descargar el SVG de unDraw, guardar en `assets/` y usar el
  nombre del archivo (sin `.svg`) en el campo `illustration`
