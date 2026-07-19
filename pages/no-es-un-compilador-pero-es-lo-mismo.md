---
title: No es un compilador, pero es lo mismo
tags:
  - IA
  - Filosofía
date: 2026-07-19
template: post
description:
  En los 50 desconfiaban de los compiladores. Hoy desconfían de la IA. La
  historia se repite, con los mismos argumentos y la misma venta de humo.
illustration: ai_code_generation
---

En Reddit alguien dijo que no se puede programar con IA porque es una caja
negra. No tenés idea de dónde están las cosas, hay que tener mucho cuidado, te
abatatás.

Bueno, sí. Pero también usás TypeScript, que genera no sé qué JavaScript, que
después pasa por un JIT que andá a saber qué instrucciones termina generando.
Esto es un poco de lo mismo. Hay que tener cuidado, pero podés relajarte
bastante.

No es una idea mía.
[Grady Booch](https://x.com/Grady_Booch/status/2013331606795362398), el creador
de UML, lo dijo mejor:

> The rise of AI programming agents is changing the nature of software
> development in the same way as did the introduction of compilers in the time
> of Grace Hopper. The entire history of software engineering is one of rising
> levels of abstraction.

La historia del software es una historia de capas de abstracción. Primero
escribíamos en binario. Después assembly. Después C. Después lenguajes con
garbage collector. Después lenguajes que compilan a otro lenguaje. Y ahora le
decimos a una IA lo que queremos y nos escupe código.

## El compilador es determinista, la IA no

Este es el argumento que siempre aparece. Y es cierto. Un compilador está
testeado hace décadas, es determinista, sabés exactamente qué salida esperás. La
IA no. Hoy hacés un test y anda, mañana el mismo test falla.

Pero mi punto no es que deje de existir el código fuente. No pretendo que
borremos los repos y generemos todo desde un Markdown. Mi punto es que no le
terminás dando mucha bola al código generado. Como hoy no le das bola al
assembly que genera tu compilador.

Y claro que los compiladores ya están recontra probados y la IA todavía no. Aun
así, hay nichos donde la gente se pone a mirar las instrucciones — el kernel de
Linux, los genios de ffmpeg. Pero no es lo más común y no es hacia donde vamos.

## La misma venta de humo

Cuando salió FORTRAN, [IBM decía](https://www.ibm.com/history/fortran) que
escribías "código de máquina en inglés" y que no ibas a necesitar más
programadores. Suena familiar.

En su momento había muchos casos donde los compiladores generaban código peor
que el assembly escrito a mano. Y la gente desconfiaba, con razón. Hoy pasa lo
mismo con la IA: errores, alucinaciones, código inseguro, tests que pasan y
después fallan.

Pero los compiladores terminaron ganando. Nadie escribe assembly salvo en nichos
muy específicos. El tradeoff entre productividad y control se inclinó para el
lado de la productividad.

No veo un escenario donde no programemos con IA. Ni siquiera cuando el costo se
"sincerice" y deje de estar subsidiado por venture capital. La dirección es
clara.

## No es todo o nada

El error es pensar que es binario. Que o programás 100% a mano o delegás 100% en
la IA. Lo mismo pasaba con los compiladores: no era "assembly vs FORTRAN", era
"uso FORTRAN para el 90% y optimizo a mano el 10% crítico".

Con la IA es igual. La usás para el boilerplate, para explorar ideas, para que
te tire la primera versión de una función. Después revisás, ajustás, arreglás.
El criterio sigue siendo humano.

Hay mucho sentimiento anti-IA dando vueltas, el mismo que había con los
compiladores. Está bien ser escéptico. Pero también está bien reconocer un
patrón histórico cuando lo ves. **Ya vimos esta película, y sabemos cómo
termina.**

*Este post fue generado con IA en base a un [intercambio genuino en Reddit](https://www.reddit.com/r/devsarg/comments/1uziqee/comment/oy8ai5b/?context=3).*
