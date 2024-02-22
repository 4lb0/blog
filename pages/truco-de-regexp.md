---

title: Truco de Expresiones Regulares
tags:
 - Tips
 - Regexp
date: 2024-02-23
template: post
description: Como matchear con expresiones regulares lo que esta dentro de comillas o tags.
illustration: file_searching

---

Por ejemplo, tenemos este HTML:

```html
<p class="alguna_clase">Lorem ipsum</p>
```

Y queremos obtener lo que esta entre comilllas usamos, en vez de poner \w o los caracteres que queremos:

```
/"\w+"/
/"[a-z0-9 \-_]+"/
```

directamente le decimos dame todo lo que **no sea una comilla**:

```
/"[^"]+"]/
```

Esto es que encuentre una comilla, luego abrimos el grupo y le decimos que no sea una comilla, con el **+** le decimos que encuentre una o mas veces, hasta que encuentre una comilla. No confundirse con el `^` usado al comienzo que indica que este al principio de la cadena (o línea si estas usando el modo multiline), cuando esta en un grupo se usa como negación de los caracteres de ese grupo.

Para el caso de lo que esta entre los tags (las etiquetas):

```
/>[^<]+</
```

Esto no puede parsear un JSON o cualquier cosa que esperemos que tenga una comilla escapada, como `"esto \"no funciona\" aca"`.

Tampoco puede parsear un tag dentro de otro. Para eso ya hay que capturar el tag, matchearla con el otro y hacer que la regexp no sea greedy, eso es para otro post.
