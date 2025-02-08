---

title: Dominios dev.ar
tags:
 - Proyectos
date: 2025-02-08
template: post
description: Les cuento la historia del proyecto, como surgió y como sigue.
illustration: domain_names

---

Cuando se habilitaron los dominios de menos de 3 letras en NIC.ar, me olvidé exactamente la fecha en que lo iban a habilitar, así que fui probando y me adelanté. Llegué a [registrar varios que me parecían interesantes](https://domains.pragmore.com/), entre ellos [**dev.ar**](https://home.dev.ar).

Los dominios `.dev` son relativamente nuevos y se usan entre los desarrolladores (*developers*). El TLD (*Top-Level Domain*, dominio de nivel superior) fue comprado por Google.

## Que hacer con dev.ar

Mi intención era vender esos dominios y logré vender algunos pocos. Pero con [dev.ar](https://home.dev.ar) me pasó que intenté usarlo como proyecto. Primero quise ver cuánto interés había, si la gente iba a pagar, si se podía usar como servicio freemium o qué. Si bien hubo un nicho al que le interesó, tampoco cuento con un alcance suficiente para promocionarlo.

Para esto, armé un formulario de registro en Google Forms, donde contactaba a la gente y, si querían apuntarlo a algún lado, lo hacía a mano. Eran muy pocos los que ya tenían un lugar donde apuntarlo; el mayor problema era que la mayoría no sabía qué necesitaba ni cómo hacerlo. Los que sabían, de hecho, era porque ya tenían un dominio comprado.

Así que terminé decidiendo rápidamente que iba a darlo gratis. Cuando empecé a programar para la web, los dominios `.com.ar` [eran gratis](https://www.cronista.com/negocios/Dejan-de-ser-gratuitos-los-dominios-ar-20140225-0024.html). Esto hacía que mucha gente registrara muchos solo para venderlos, lo cual era bastante molesto. Pero también permitía que cualquiera, sin costo, armara un proyecto y lo probara. O tuviera su propia web personal, como un blog.

## El desarrollo

Mientras el formulario seguía activo, empecé a programarlo. Primero en alguna plataforma para practicar un poco más, después en algo más conocido y rápido para hacer un prototipo como Laravel, y finalmente, como estaba jugando con hacer un lenguaje propio, terminé programándolo en un [framework web](https://bialet.dev) que hice en un lenguaje de scripting poco conocido llamado [Wren](https://wren.io).

Tampoco me decidía por el diseño, así que terminé bajando un template HTML gratuito y, a partir de ahí, en pocas horas terminé de programarlo. El código está disponible en [GitHub](https://github.com/pragmore/bialet.dev).

Una vez publicado, lo terminé promocionando nuevamente en Reddit, donde tuvo nueva llegada. También contacté por privado a tres creadores de contenido sobre programación argentinos: Maxi Firtman, Goncy y SoyDalto, ofreciéndoles un dev.ar. Goncy y Maxi me contestaron muy amablemente e incluso Maxi lo publicó en su Twitter. Esto hizo más ruido.

Tanto ruido que llegó **NIC.ar** y me amenazó con dar de baja el dominio. Y con justa razón: estaba publicando dominios terminados en `dev.ar` cuando, primero, no eran dominios y, segundo, la única autoridad para hacerlo son ellos.

## La reacción de NIC.ar

NIC.ar respondió rápidamente a las consultas y en menos de dos días cambiamos todos los lugares donde decía “dominio” por **“espacios”** (aunque técnicamente son subdominios, para evitar cualquier confusión con la palabra dominio). También se aclaró bien en grande en los términos legales y en el pie de página que no hay relación alguna con NIC.ar.

Ahora, ¿por qué decía "dominios" cuando sabía que solo eran subdominios? Simplemente para evitar tener que hacer una explicación técnica. Como ya mencioné, la mayoría de la gente que me contactó no sabía la diferencia entre uno y otro, ni mucho menos cómo funcionan los DNS y la resolución de dominios. Nunca hubo intención de engañar a nadie, y creo que nadie se sintió engañado tampoco.

## ¿Cuánto tiempo va a seguir?

Los dominios `dev.ar` se renuevan anualmente, no se pueden renovar por más de un año. Ya hice la renovación. El costo anual, junto con el servidor (que es una VPS chica en Hetzner), es bajo, así que lo puedo pagar de mi bolsillo. Mientras eso se mantenga, no tengo problema.

La configuración de DNS se maneja en Cloudflare, en la capa gratuita, que tiene un límite de cerca de **1.000 configuraciones**. Configurar un DNS propio tiene más costo. Todavía estamos lejos de ese límite, pero cuando estemos cerca veremos cómo seguimos: si dejo de permitir más configuraciones con DNS, si cambiamos de proveedor… todavía no lo sé. Como decía un compañero de laburo: *problema para el Albo del futuro*.

## El mayor problema: los spammers

Ahora el mayor problema son los **spammers** y la gente que se quiere aprovechar. Como dije, cuando el `.com.ar` era gratuito, la gente registraba miles de dominios solo para tenerlos reservados. No quiero que pase lo mismo con `dev.ar`. Todavía hay pocos casos, pero ya me rompen las pelotas. Si en algún momento se vuelve un problema grave o legal, seguro doy de baja el alta de nuevos subdominios y mantengo solo los que ya están.

## ¿Qué aprendí de todo esto?

Bueno, en principio, mi framework [Bialet](https://bialet.dev) funciona bien. Se banca el tráfico (aunque sea poco) y fue muy rápido programarlo ahí, aunque el código es chico.

También aprendí que el famoso dicho *“das la mano y te agarran el codo”* es real. Ya me lo imaginaba, pero sigue siendo la peor parte de todo esto. Por suerte, se compensa con la gente que realmente lo aprovecha: chicos que recién están empezando y muestran su portfolio, gente que hace proyectos, comunidades, etc.

Aunque lo principal que aprendí es lo **difícil que es promocionar algo cuando no tenés llegada**. Incluso en comunidades donde podría generar interés, como Reddit, todo depende del momento en que se publica. Si no se ve en el momento justo, después se comparte muy despacio. Incluso cuando es un servicio gratuito y útil.
