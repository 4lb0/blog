---
title: Tips para trabajar con agentes
tags:
  - IA
  - Tips
date: 2026-11-23
template: post
description: Cache, subagentes y multiagentes. Cómo estirar el plan sin vivir limpiando la conversación.
illustration: ai_agent
---

Trabajar con agentes tiene su maña. No es el prompt perfecto, es entender que el
contexto es un recurso y que cada mensaje cuesta. Estos son los tips que me
sirvieron, de los más obvios a los que requieren un poco de criterio.

## No limpies la conversación todo el tiempo

El consejo que más se repite es tirar un `/clear` por cada tarea terminada,
porque el modelo relee toda la conversación en cada mensaje. Suena lógico, pero
se olvida de la cache.

Mientras seguís en la misma conversación, lo que ya mandaste está cacheado, y
pegarle a la cache cuesta una fracción de mandarlo de nuevo. Si todavía no
llegaste al límite de contexto, seguir ahí es lo más barato. La cache dura cinco
minutos por defecto, se puede estirar a una hora, y cuando la conversación se
acerca al límite el agente hace un `/compact` solo: te resume todo y sigue.

Traducción: el `/clear` sirve cuando terminaste de verdad. Si limpiás para
después pedir algo relacionado, estás pagando dos veces los mismos tokens.

## Mandá el ruido a un subagente

Leer veinte archivos para encontrar un bug es carísimo en contexto. Un subagente
se come todo eso y te devuelve un resumen. Es como delegar en un compañero: no
querés el detalle de cada archivo, querés la conclusión.

## Automatizá lo repetitivo, no todo

Si repetís el mismo pedido todas las semanas, va a un archivo de instrucciones
global, tipo [AGENTS.md](https://agents.md/):

```markdown
Implement this JIRA ticket YYY. Follow the implementation plan I put together in
there. Let me know if you have any questions.
```

O mejor, una skill `/jira YYY` que cargue ese contexto sola. Sumale que corra las
pruebas y te arme un reporte en HTML con screenshots. Ojo: eso no reemplaza las
pruebas manuales, sirve para cazar los errores obvios rápido y seguir trabajando
en paralelo.

## Multiagentes, pero con criterio

Cuatro agentes en paralelo se justifican con tareas largas y sin mucha
supervisión: dos tickets, una auditoría de seguridad, bajar el tiempo de los
tests. Lo único que dejaría automático de punta a punta son los PRs de una línea,
cambiar un texto o un link.

Dos avisos. Uno: coordinando agentes te vas a quemar más que escribiendo código.
Dos: en una auditoría grande te quedás sin tokens a mitad de camino, así que
conviene elegir bien qué mandás.

## Pensá un poco antes de delegar

Tengo un compañero que le tira absolutamente todo: que le lea los mails, las
notificaciones de Jira, todo. Para mí es demasiado.

El punto medio es simple: si algo lo hacés en dos minutos a mano, no necesitás un
agente. Y los que presumen diez agentes en simultáneo... si hasta tienen uno para
que les avise que a las 12.30 hay que pedir la comida, más vale que tienen diez.
La mitad podría ser un cron.

Al final el mejor tip es el más aburrido: entender cuánto cuesta cada cosa y no
automatizar por deporte.

_Este post fue generado con IA en base a una conversación sobre cómo trabajar con
agentes._
