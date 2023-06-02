---

title: Optimizaciones del blog
tags:
 - Desarrollo web
date: 2023-06-05
template: post
description: Un blog que tiene una imagen y un texto, ¿cuánto mas se puede optimizar?
illustration: speed_test

---

Antes de seguir leyendo, mirá cuanto tarda pesa y cuantos requests hace. Emulá la conexión como si fuera 3G lento. Si no tenes ganas de verlo con tus propios ojos esto pesa menos de 16kb y hace un solo request. Ahora si, a las optimizaciones.

## Compresión

El primer paso es sencillo. Hay que comprimir todo el request. Pero zipearlo no es suficiente, hay que usar [brotli](https://github.com/google/brotli) que esta hecho para la web, tiene un diccionario de datos con palabras comunes y tags HTML. Para esto hubo que instalar el [módulo](https://github.com/google/ngx_brotli) a mano en nuestro Nginx. Cloudflare lo hace por defecto pero lo quitamos.

## Sacarlo de GitHub Pages y Cloudflare

Los dos son grandes servicios pero agregan ~2kb en headers a los requests dependiendo de las cookies y otros factores. Como van a ver hasta el final aca estamos exprimiendo cada byte, hasta le [quité la cabecera del server](https://www.getpagespeed.com/server-setup/nginx/how-to-remove-the-server-header-in-nginx).

## Tener un solo request de menos de 14kb

La culpa es del protocolo TCP. Tu servidor no sabe cuantos datos se banca la conexión y empieza enviandote 10 paquetes. El paquete máximo de TCP es de 1500 bytes. A eso hay que quitarle 40 bytes de las cabeceras. [Eso da apróximadamente 14kb](https://endtimes.dev/why-your-website-should-be-under-14kb-in-size/). Para un solo request necesitamos primero quitar cualquier CDN, además ya que no [cachean como antes](https://gomakethings.com/cdn-caching-isnt-the-performance-boost-it-used-to-be/) y por supuesto que el CSS este todo includo en `style`, fácil. Ah y también hacemos que el [favicon sea un emoji](https://css-tricks.com/emoji-as-a-favicon/). Por último necesitamos que la imagen también sea inline. Para esto lo [convertis a base64](https://stackoverflow.com/questions/8499633/how-to-display-base64-images-in-html). Si el base64 hace que tu imagen ahora pesé un ~33% mas. Por eso vayamos a optimizar imágenes.

## Imágenes

Para optimizar imágenes pasé por muchas etapas. [Dithering](https://analyticsindiamag.com/what-is-dithering-in-image-processing-and-how-it-maintains-image-quality/) que es hacer un pixelado con un ruido. Quitar metadatos, reducir la paleta de colores y bajar la calidad de los JPG o PNG, todo esto lo hace [TinyPNG](https://tinypng.com/). Por último encontré un catalogo de SVG, y no hay nada que le gane a un SVG.

## Otros

Además en el HTML se quitaron espacios y comillas con una [librería de PHP](https://github.com/WyriHaximus/HtmlCompress). Se quitó el dark mode para que sea mas liviano. Se eligió delegar la mayoría de los estilos en los que vienen por defecto. Para la fuente por supuesto no se iba a agregar ninguna externa, y había que quitar si o si el horrible Times New Roman, casualmente me topé con [system-ui](https://caniuse.com/font-family-system-ui), que es la fuente que tiene configurada el sistema por defecto. Todo esto por supuesto midiendo con la consola y tomando métricas como el [First Contenful Paint](https://web.dev/i18n/es/fcp/) y [tiempo de interacción](https://web.dev/i18n/es/tti/).

Como leyeron fueron muchas optimizaciones, muchas horas de investigación y mas horas de prueba y error (si muchas mas horas que escribiendo).
