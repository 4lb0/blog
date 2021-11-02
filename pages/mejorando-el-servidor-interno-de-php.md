---

title: Mejorando el servidor interno de PHP 
tags:
 - php 
 - tools
date: 2021-11-02
template: post
description: Lo que necesitaba era una manera mas fácil de correr LiveReload, varios servidores al mismo tiempo y tener a mano la url del servidor asi que aca esta: phps, el reemplazo a php -S.

---

![Como se ve cuando se ejecuta el script phps](images/phps.png)

Desde que estoy programando con Node y React hay varias cosas que extraño cuando vuelvo a PHP. Muchas tienen que ver con el servidor.

* [LiveReload](https://github.com/livereload/), es lo que hace que se refresque todo cuando haces un cambio.
* El servidor generado por [http-server](https://www.npmjs.com/package/http-server) te muestra los links para que hagas click desde la consola, tanto a localhost como a la URL de la red, ideal para poder probar en mobile.

Además me cansa tener que andar poniendo un puerto o tener que definir uno al azar. Asi que con todo eso hice [phps](https://github.com/4lb0/phps).

Se puede instalar con composer de manera global:

    composer global install 4lb0/phps

Después lo ejecutas con los mismos parámetros que usas para el [servidor interno de PHP](https://www.php.net/manual/es/features.commandline.webserver.php). Por ejemplo si tu router es servidor.php y el resto de los archivos estan en la carpeta public ejecutas `phps -t public servidor.php`. También lo podes configurar desde `composer.json` solo lo llamas con `phps`. Asi te queda la configuración.

    "extra": {
      "phps": "-t public servidor.php"
    }

Para que lo habra en un puerto al azar agregale el parámetro `-r` a la llamada del phps. Por ahora no es configurable por composer.json.


[Ver el proyecto en GitHub](https://github.com/4lb0/phps)
