---
name: escribir-post
description:
  Crea un post nuevo para el blog de punta a punta: redacta el contenido con
  el estilo propio del autor (estilo-propio/SKILL.md), busca y descarga una
  ilustración SVG de unDraw para assets/, arma el frontmatter y guarda el
  archivo en pages/. Usar cuando el usuario pida escribir, redactar, armar o
  publicar un nuevo post del blog.
---

# Escribir un post nuevo

Este skill guía la creación completa de un post: tono, estructura, ilustración
y archivo final en `pages/`.

## 0. Tema

Si el usuario no dio un tema concreto (o dio algo muy vago), preguntá de qué
quiere escribir antes de avanzar. Si ya lo dio, seguí directo.

## 1. Cargar el estilo propio

Antes de escribir una sola línea, leé **`estilo-propio/SKILL.md`** (raíz del
repo) completo y aplicá esa voz: vos rioplatense, tono cercano, muletillas
("Bueno", "Aca", arrancar un párrafo con "No" para contradecir), oraciones
cortas, humor auto-despreciativo, links generosos, sin bajar línea, sin
emojis, sin relleno.

## 2. Estructura del post (según los últimos posts del blog)

Reviso siempre 2-3 posts recientes de `pages/*.md` (ordenados por el campo
`date`, no por fecha de archivo) antes de escribir, para no perder la mano.
Patrones consistentes:

- **No hay H1 ni se repite el título** dentro del cuerpo: el template ya
  renderiza `title` como `<h1>` y `description` como párrafo aparte arriba de
  la ilustración. El cuerpo arranca directo con el desarrollo, no repite ni
  la descripción ni el título.
- Arranque directo, sin rodeos, a veces una sola oración fuerte.
- Secciones con `##` cuando el post tiene varias ideas (no siempre hace
  falta — posts cortos van sin subtítulos).
- Párrafos de 2 a 6 líneas. Nada de bloques gigantes.
- Cierre con una reflexión, una frase contundente o algo en **negrita** que
  resume la idea central. A veces una sección final `## Referencias` con
  lista numerada de notas al pie.
- Links en markdown a todo lo que se menciona (proyectos, docs, Wikipedia,
  otros posts propios).

## 3. Frontmatter

Formato exacto (con líneas en blanco después del `---` de apertura y antes
del de cierre, como en los posts existentes):

```markdown
---

title: Título del post
tags:
 - Tag1
 - Tag2
date: YYYY-MM-DD
template: post
description: Descripción corta, con la voz del autor, que enganche (se muestra como copete arriba de la ilustración).
illustration: nombre_del_svg

---
```

- `date`: la fecha real de hoy salvo que el usuario indique otra.
- `tags`: revisar tags ya usados en otros posts (`grep -h "^ -" pages/*.md`)
  y reusarlos si aplica, en vez de inventar uno nuevo por las dudas.
- `template`: siempre `post`.
- `illustration`: el nombre de archivo SIN extensión, ver paso 4.

## 4. Ilustración de unDraw

unDraw no tiene una API pública documentada, pero el buscador del sitio pega
contra un endpoint JSON que se puede usar directo por curl:

```bash
curl -s "https://undraw.co/api/search?query=<termino-en-ingles>"
```

Devuelve algo como:

```json
{"results":[{"title":"Programmer","newSlug":"programmer_raqr","media":"https://cdn.undraw.co/illustration/programmer_raqr.svg"}, ...]}
```

Pasos:

1. Pensar 1-2 palabras clave **en inglés** que resuman el tema del post (ej.
   "writing", "problem solving", "domain names").
2. Buscar con ese endpoint (el query tiene que tener 3+ caracteres).
3. Elegir el resultado que mejor combine con el post.
4. Descargar el SVG directo a `assets/`, usando un nombre de archivo
   descriptivo en snake_case (podés simplificar el `newSlug` sacándole el
   sufijo random, como ya se hizo con `going_up.svg`, `problem_solving.svg`,
   `file_searching.svg` en el repo):

```bash
curl -s "https://cdn.undraw.co/illustration/programmer_raqr.svg" -o assets/nombre_elegido.svg
```

5. Poner ese mismo nombre (sin `.svg`) en el campo `illustration` del
   frontmatter.

Si ningún resultado convence, probar con otro término antes de forzar uno
mediocre. La ilustración es opcional: si de verdad no hay nada que quede
bien, se puede omitir el campo `illustration`.

## 5. Guardar el archivo

- Nombre de archivo: slug descriptivo en español, minúsculas, separado por
  guiones, sin `.md` repetido dos veces (ej. `pages/mi-nuevo-post.md`). Ese
  nombre define la URL final.
- Confirmar que no exista ya un post con ese nombre (`ls pages/`).

## 6. Verificación opcional

Si el usuario quiere ver el resultado:

```bash
php build.php
php -S 127.0.0.1:8000 -t public app.php
```

No hace falta hacer commit ni push salvo que el usuario lo pida explícitamente.
