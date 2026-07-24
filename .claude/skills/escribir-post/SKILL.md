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

## 0. Tema y origen

Si el usuario no dio un tema concreto (o dio algo muy vago), preguntá de qué
quiere escribir antes de avanzar.

Aunque el usuario ya haya dado un tema, siempre hay que hacer estas preguntas
para ampliar el contexto antes de escribir:

1. **¿De dónde salió la idea?** — ¿Fue un comentario de Reddit, un hilo de
   Twitter, una conversación, un podcast o video, un artículo que leíste, una
   ducha mental? Esto es el "ramble" que originó el post.
2. **¿Hay un link a ese ramble?** — Si fue online, pedí la URL concreta del
   comentario/hilo/tweet (con `?context=3` si es Reddit para dar contexto).
3. **¿Qué puntos o ángulos querés cubrir?** — ¿Hay algo específico que
   querés que quede claro? ¿Alguna idea que no querés que se pierda?
4. **¿Algo más que quieras agregar?** — Pregunta abierta para capturar lo
   que el usuario no mencionó espontáneamente.

Si el usuario quiere que sea un post 100% humano (sin intervención de IA),
que lo diga acá. Por defecto se asume que el post se arma con IA a partir
del ramble.

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

## 3. Nota de IA al pie del post

Salvo que el usuario haya pedido explícitamente un post 100% humano, **siempre**
se agrega al final del cuerpo una nota en cursiva aclarando que el post fue
generado con IA y linkeando al ramble original. El tono es natural, sin pedir
disculpas.

Formato base (italiano con `*` o `_`, según el estilo del resto del post):

```
_Este post fue generado con IA en base a un [intercambio genuino en Reddit](URL)._
```

Si el ramble no fue online (conversación, charla, idea propia), se adapta:

```
_Este post fue generado con IA en base a una conversación que tuve con un colega._
```

Si fue un artículo, podcast o video:

```
_Este post fue generado con IA en base a [un episodio de tal podcast](URL)._
```

Si hubo preguntas de la IA para ampliar — como en `panaderias-de-codigo.md` — se
menciona también:

```
_Este post fue generado con IA en base a un [post en Reddit](URL), junto a
respuestas a preguntas que hizo la IA para ampliar lo que pienso._
```

La nota va **siempre en la última línea del cuerpo**, después del cierre y
separada por un renglón en blanco. No lleva subtítulo ni sección propia — es un
detalle suelto al final.

## 4. Frontmatter

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
  y reusarlos si aplica, en vez de inventar uno nuevo por las dudas. Según el
  contenido del post, sugerir al usuario los tags existentes que mejor encajen
  (ej. si habla de IA con tono reflexivo, sugerir `IA` y `Filosofía`).
- `template`: siempre `post`.
- `illustration`: el nombre de archivo SIN extensión, ver paso 5.

## 5. Ilustración de unDraw

Antes de buscar, revisar qué ilustraciones ya existen para no repetir:

```bash
ls assets/*.svg
```

unDraw no tiene una API pública documentada, pero el buscador del sitio pega
contra un endpoint JSON que se puede usar directo por curl:

```bash
curl -s "https://undraw.co/api/search?query=<termino-en-ingles>"
```

La URL equivalente en el navegador sería
`https://undraw.co/search/<termino-en-ingles>` (ej.
`https://undraw.co/search/artificial`).

Devuelve algo como:

```json
{"results":[{"title":"Programmer","newSlug":"programmer_raqr","media":"https://cdn.undraw.co/illustration/programmer_raqr.svg"}, ...]}
```

Pasos:

1. Pensar 1-2 palabras clave **en inglés** que resuman el tema del post (ej.
   "writing", "problem solving", "artificial", "code").
2. Buscar con el endpoint (el query tiene que tener 3+ caracteres).
3. Elegir un resultado que **no esté ya en `assets/`** y que combine con el
   post. No tiene que ser una ilustración exacta del tema — algo que tenga
   sentido visual y sirva para que no quede solo texto.
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

## 6. Guardar el archivo

- Nombre de archivo: slug descriptivo en español, minúsculas, separado por
  guiones, sin `.md` repetido dos veces (ej. `pages/mi-nuevo-post.md`). Ese
  nombre define la URL final.
- Confirmar que no exista ya un post con ese nombre (`ls pages/`).

## 7. Verificación opcional

Si el usuario quiere ver el resultado:

```bash
php build.php
php -S 127.0.0.1:8000 -t public app.php
```

No hace falta hacer commit ni push salvo que el usuario lo pida explícitamente.
