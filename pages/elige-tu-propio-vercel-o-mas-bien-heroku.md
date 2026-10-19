---
title: Elige tu propio Vercel (o más bien Heroku)
tags:
  - Tips
  - Proyectos
date: 2026-10-19
template: post
description:
  Segunda parte de la guía para subir webs a un VPS, esta vez armando Nube, un
  mini-PaaS que publica cada app con git push, HTTPS y base de datos incluidos.
illustration: push-to-production
---

En la
[guía para subir webs a hosting o VPS](guia-para-subir-webs-a-hosting-o-vps.html)
dejé las piezas sobre la mesa: un VPS, nginx, PHP-FPM, MySQL, DNS y
certificados. La teoría está bien, pero en la práctica cada proyecto nuevo
arranca con la misma ceremonia: crear el usuario, la carpeta, el virtual host,
la base de datos, el certificado y el script que copia los archivos. Si tenés un
proyecto, es un rato. Si tenés cinco, es una tarde y siempre te olvidás de algo.

Heroku resolvió eso hace años con una idea muy simple: hacés `git push` y la app
queda publicada. Vercel y otros hacen un pull del repositorio. No es mucho más
complicado, para mí el push es más simple para este caso donde no vas a escalar
horizontalmente.

Más allá del plan inicial gratuito, Vercel es mucho más caro que una VPS. Ni
hablar de Heroku. Por supuesto estás pagando su servicio de hacer de DevOps.
Para mí en tiempos de IA no es tan difícil hacerlo uno mismo.

Lo vengo usando hace varios años internamente, y de hecho lo tenía público, pero
lo tuve que quitar porque le agregué data muy concreta de algunos proyectos que
estoy trabajando. Por eso publiqué la versión anterior en
[GitHub como VPS](https://github.com/4lb0/vps).

**Usala como base para armar la tuya**, toda la primera parte le podés pedir a
la IA que lo deje todo configurado, que haga pruebas, y lo deje lo más armado
posible. Luego te encargas de entrar por SSH y generar los proyectos con los
comandos (ej `add-domain.sh`).

## La idea

Nube tiene **un solo usuario de deploy** (`nube`) y **un dominio base**
(`nube.example.com`). Cada app vive en un subdominio y se publica con un push:

```bash
git push server main   # aplica la configuración del servidor
git push prod main     # publica una app
```

Son dos flujos distintos a propósito. El repositorio del servidor no es una app:
contiene `nginx/`, `fail2ban/` y los scripts. Cuando le hacés push, el servidor
copia esa configuración a `/etc`, valida con `nginx -t` y recarga. Si `nginx -t`
falla, revierte el cambio y el push termina con error. O sea: el servidor se
configura desde git, no entrando a editar archivos a mano.

El otro flujo es el de siempre, el de Heroku:

```text
git push prod main
        │
        ▼
~/git/blog.git  ──►  hook post-update
                          │
                          ├─ checkout en /var/www/blog.example.com
                          ├─ arma el .env con los datos de la base
                          ├─ instala dependencias según el stack
                          ├─ corre migraciones y cachés si es Laravel
                          └─ ejecuta .nube/deploy si existe
```

Al final, nginx sirve el sitio, Node / Python o PHP-FPM ejecuta el código y
MySQL guarda los datos. Nada nuevo: la diferencia es que está automatizado y
versionado.

## Lo que necesitás

- Un VPS con Ubuntu 24.04 LTS y acceso root por SSH. La guía anterior explica
  cómo elegirlo y qué tiene que tener.
- Un dominio con dos registros DNS:

```text
nube.example.com       A   203.0.113.10
*.example.com     A   203.0.113.10
```

Por supuesto no hace falta que se llame Nube, ponele el nombre que quieras. A mí
me gusta decir que mi proyecto lo tengo en la nube.

El wildcard es clave: con eso cualquier subdominio nuevo (`blog.example.com`,
`app.example.com`) ya apunta al servidor sin crear un registro cada vez. También
hay que emitir un certificado wildcard con `acme.sh`; está documentado en el
repo y no lo voy a repetir acá.

## Instalación

La idea es que cada servidor tenga su propio fork, así podés tocar nginx o
fail2ban sin afectar a nadie. En el VPS:

```bash
sudo apt update && sudo apt install -y git
sudo git clone https://github.com/TU-USUARIO/vps.git /opt/nube
cd /opt/nube

sudo ./bootstrap.sh \
    --base-domain nube.example.com \
    --email yo@example.com \
    --ssh-key-file ~/.ssh/id_ed25519.pub
```

`bootstrap.sh` es idempotente. Crea `/etc/nube/nube.conf`, instala los comandos,
aplica la configuración de nginx y fail2ban, crea el usuario de deploy con
`git-shell`, le instala tu clave SSH y deja el repositorio del servidor con su
hook.

Después, desde tu máquina, apuntás tu fork al servidor y aplicás la
configuración:

```bash
git remote add server nube@nube.example.com:git/nube
git push server main
```

Ese push no publica ninguna web: deja el servidor con la configuración que está
en tu repo. Es raro la primera vez, después se agradece.

## Publicar una app

Supongamos que querés publicar un blog. Primero preparás el subdominio:

```bash
sudo runuser -u nube -- nube-add-subdomain blog
```

Eso crea `~/www/blog.nube.example.com/public`, el symlink en `/var/www` y una
página provisoria. Después creás el repositorio y la base de datos:

```bash
sudo runuser -u nube -- nube-add-repository blog blog.nube.example.com | sudo mysql
```

`nube-add-repository` crea el repositorio bare en `~/git/blog.git`, le pone el
hook de deploy y escribe por stdout el SQL que crea la base y el usuario de
MySQL. Por eso el pipe a `sudo mysql`: hacés las dos cosas en un comando.

Por último, en la carpeta de tu proyecto:

```bash
git remote add prod nube@nube.example.com:git/blog
git push prod main
```

Y listo: `https://blog.nube.example.com`. El hook imprime el progreso en la
terminal y deja el detalle en `~/nube-deploy.log` si algo falla.

## La demo

Un deploy completo de una app PHP, desde el push hasta la URL:

<script src="https://asciinema.org/a/449183.js" id="asciicast-449183" async="true"></script>

## Qué detecta el deploy

No hay que declarar el stack en ningún archivo. El hook mira lo que hay en el
repositorio:

- Si encuentra `artisan`, es Laravel: genera `APP_KEY` si falta, ajusta
  permisos, cachea configuración, rutas y vistas, y corre
  `php artisan migrate --force`.
- Si encuentra `composer.json`, corre `composer install`.
- Si encuentra `package.json`, corre `npm ci` (o `npm install` si no hay
  lockfile) y `npm run build` si existe el script.
- Si encuentra `ecosystem.config.js`, recarga el proceso con PM2.
- Si encuentra `requirements.txt` o `pyproject.toml`, crea un `.venv` e instala
  dependencias con `pip`.
- Si es un sitio estático, alcanza con que los archivos estén en `public/`.

Para lo que no entra en ninguna receta está `.nube/deploy`, un script ejecutable
que corre al final del deploy con variables como `NUBE_PATH`, `NUBE_URL`,
`NUBE_DOMAIN` y las credenciales de la base. Ahí van los `storage:link`, los
workers, los pasos de build propios o lo que necesite el proyecto.

## El `.env`

El hook no pisa secretos. Si versionás un `.env.example` con placeholders, en
cada deploy los reemplaza por los valores reales:

```dotenv
APP_NAME=Blog
APP_URL=#NUBE_URL#

DB_CONNECTION=#NUBE_DB_CONN#
DB_HOST=#NUBE_DB_HOST#
DB_DATABASE=#NUBE_DB_NAME#
DB_USERNAME=#NUBE_DB_USER#
DB_PASSWORD=#NUBE_DB_PASS#
```

Las variables que no son placeholders quedan como estén en el `.env` del
servidor. Eso permite cargar a mano una `MAIL_PASSWORD` o una API key sin que el
próximo push la borre.

## Los límites

Primero que nada, el código de la VPS no es igual al que hay hoy en día
productivo en mi servidor. Usalo como base, para crear el tuyo. Adaptalo y
probalo.

Nube está pensado para **un VPS, un dueño y un dominio base**. No es un hosting
multi-tenant: si necesitás alojar clientes que no confían entre sí, va un VPS
por cliente. Tampoco tiene panel web, autoescalado ni deploy blue/green.

Hay otras decisiones que conviene tener claras:

- Todos los sitios corren, por defecto, como `www-data`.
- Quien puede hacer push al repositorio del servidor puede instalar
  configuración como root. Es el objetivo del proyecto, pero esa clave hay que
  cuidarla.
- La clave GPG que cifra las credenciales no tiene passphrase, para que el
  deploy sea no interactivo. Protege de una lectura casual, no de root.
- El deploy hace `checkout` sobre el directorio vivo. Durante uno o dos segundos
  puede haber archivos mezclados; para la mayoría de los proyectos es
  imperceptible, pero no es zero downtime.
- Los backups, las actualizaciones y la seguridad del sistema siguen siendo
  tuyos. En el repo hay una guía y un script de ejemplo, pero no se hacen solos.

## Para cerrar

La guía anterior explicaba las piezas. Esta automatiza el armado. No es un
reemplazo de Vercel ni pretende serlo: es la versión chica y transparente que
puedo leer entera, adaptar y arreglar sin abrir un ticket.

El código, los ejemplos y la documentación están en
[github.com/4lb0/vps](https://github.com/4lb0/vps).
