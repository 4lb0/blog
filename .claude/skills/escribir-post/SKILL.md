---
name: escribir-post
description: >-
  Crea un post nuevo para el blog de punta a punta: redacta el contenido con
  el estilo propio del autor (skill estilo-propio), busca y descarga una
  ilustración SVG de unDraw para assets/, arma el frontmatter y guarda el
  archivo en pages/. Usar cuando el usuario pida escribir, redactar, armar,
  convertir o publicar un post del blog, incluso si pega material crudo (un
  chat, un hilo de Reddit, notas sueltas) y dice "convertí esto en un post".
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

## 1. Definir el eje (antes de escribir una línea)

El material crudo casi nunca es un post. Un chat, un hilo o una lista de notas
tiene idas y vueltas, temas mezclados y respuestas que solo tienen sentido en
contexto. **El post no es un resumen del material: es un texto nuevo que lo
usa como insumo.**

Si el material tiene dos conversaciones o dos temas, no las pongas una abajo de
la otra con subtítulos. Eso se lee como chat pegado. Elegí **un solo eje** que
contenga lo importante y descartá lo que no cuelga de ahí.

Antes de escribir, acordá con el usuario:

1. **Eje**: ¿cuál es la idea que sostiene todo el post? (ej. "el contexto
   cuesta", "cuándo no usar un agente", "tips para X").
2. **Tono**: seco y técnico, filoso, charla de laburo, o el registro habitual
   del blog.
3. **Largo**: corto (~600 palabras), medio (900-1200) o largo con ejemplos.
4. **Origen**: ¿se menciona el hilo/debate que lo originó, se citan mensajes,
   o el post se sostiene solo?
5. **Audiencia**: dev que ya usa la herramienta o alguien que recién arranca.

Con esas respuestas armá un esqueleto de 3 a 5 secciones y recién ahí
redactá. Si algo del material no entra en el eje, no lo fuerces: se descarta.

## 2. Cargar el estilo propio

Antes de escribir una sola línea, cargá el skill **`estilo-propio`** (está en
`~/.agents/skills/estilo-propio/SKILL.md`) y aplicá esa voz: vos rioplatense,
tono cercano, muletillas ("Bueno", "Aca", arrancar un párrafo con "No" para
contradecir), oraciones cortas, humor auto-despreciativo, links generosos, sin
bajar línea, sin emojis, sin relleno.

Si el usuario eligió un tono distinto en el paso 1, ese manda, pero la voz de
base sigue siendo la misma.

## 3. Estructura del post (según los últimos posts del blog)

Revisá siempre 2-3 posts recientes de `pages/*.md` (ordenados por el campo
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

## 4. Nota de IA al pie del post

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
detalle suelto al final. Si el usuario pidió no mencionar el hilo original, la
nota se adapta (sin link, sin detalles del intercambio) pero **no se omite**.

## 5. Frontmatter

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
- `tags`: revisar tags ya usados en otros posts (`grep -h "^ *-" pages/*.md`)
  y reusarlos si aplica, en vez de inventar uno nuevo por las dudas. Según el
  contenido del post, sugerir al usuario los tags existentes que mejor encajen
  (ej. si habla de IA con tono reflexivo, sugerir `IA` y `Filosofía`).
- `template`: siempre `post`.
- `illustration`: el nombre de archivo SIN extensión, ver paso 6.

## 6. Ilustración de unDraw

Antes de buscar, revisar qué ilustraciones ya existen para no repetir:

```bash
ls assets/*.svg
```

unDraw no tiene una API pública documentada. El buscador del sitio pega contra
este endpoint (el parámetro es **`q`**, `query` ya no funciona y devuelve 400):

```bash
curl -s "https://undraw.co/api/search?q=<termino-en-ingles>"
```

La URL equivalente en el navegador es `https://undraw.co/search/<termino>`
(ej. `https://undraw.co/search/agent`).

Devuelve algo como:

```json
{"results":[{"title":"AI Agent","newSlug":"ai-agent_pdkp","media":"https://cdn.undraw.co/illustration/ai-agent_pdkp.svg"}, ...]}
```

Pasos:

1. Pensar 1-2 palabras clave **en inglés** que resuman el tema del post (ej.
   "writing", "agent", "code review", "server").
2. Buscar con el endpoint (el query tiene que tener 3+ caracteres).
3. Elegir un resultado que **no esté ya en `assets/`** y que combine con el
   post. No tiene que ser una ilustración exacta del tema — algo que tenga
   sentido visual y sirva para que no quede solo texto.
4. Descargar el SVG directo a `assets/`, usando un nombre de archivo
   descriptivo en snake_case (podés simplificar el `newSlug` sacándole el
   sufijo random, como ya se hizo con `going_up.svg`, `problem_solving.svg`,
   `file_searching.svg` en el repo):

```bash
curl -s "https://cdn.undraw.co/illustration/ai-agent_pdkp.svg" -o assets/ai_agent.svg
```

5. Poner ese mismo nombre (sin `.svg`) en el campo `illustration` del
   frontmatter.

Si el endpoint no responde, alternativa que funciona: el paquete npm
`undraw-svg` trae la colección completa.

```bash
cd /tmp && npm pack undraw-svg --silent && tar tzf undraw-svg-*.tgz | grep svgs/
tar xzf undraw-svg-*.tgz package/svgs/ai-agent.svg
```

**Ojo con el tamaño del SVG.** `image_size()` en `src/functions.php` busca
`width` y `height` en el root del SVG; si no están, cae al `viewBox`, pero el
regex de width/height puede matchear un `stroke-width="3"` de cualquier path y
dejar la imagen con `height="3"`. Los SVG del CDN de unDraw traen `width` y
`height`; los del paquete npm vienen solo con `viewBox`, así que hay que
agregárselos al root antes de usarlos:

```xml
<svg xmlns="http://www.w3.org/2000/svg" width="799" height="618" viewBox="0 0 799.031 618.112">
```

Después de compilar, verificá que el `<img>` generado tenga el tamaño correcto
(no `height=3`).

Si ningún resultado convence, probar con otro término antes de forzar uno
mediocre. La ilustración es opcional: si de verdad no hay nada que quede
bien, se puede omitir el campo `illustration`.

## 7. Guardar el archivo

- Nombre de archivo: slug descriptivo en español, minúsculas, separado por
  guiones, sin `.md` repetido dos veces (ej. `pages/mi-nuevo-post.md`). Ese
  nombre define la URL final.
- Confirmar que no exista ya un post con ese nombre (`ls pages/`).

## 8. Verificar

Compilá el sitio. Si no hay PHP instalado en la máquina, está la imagen Docker
del repo (Alpine + PHP 8.3, ~42 MB):

```bash
docker build -t blog-build .
docker run --rm -v "$PWD/public:/app/public" blog-build
```

Con PHP local alcanza con `php build.php`.

Checklist antes de dar el post por terminado:

- [ ] El HTML del post se generó en `public/<slug>.html`.
- [ ] La ilustración aparece, está inlinada como `data:image/svg+xml` y tiene
      `width`/`height` coherentes (no `height=3`).
- [ ] El cuerpo no repite el título ni la descripción.
- [ ] La nota de IA está en la última línea.
- [ ] El post se sostiene solo: se entiende sin haber leído el chat original.
- [ ] Los links abren y apuntan a lo que dicen.

Para verlo en el navegador:

```bash
php -S 127.0.0.1:8000 -t public app.php
```

## 9. Commit

El post va en su propio commit, con el mensaje que usa el repo (`Post <título>`).
Si el usuario pide cambios y el commit todavía no se pusheó, se **amend**; si ya
está en el remoto, un commit de fix aparte. Nunca force-push, nunca push sin
pedido explícito.
