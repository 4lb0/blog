---

title: No, vim no vale la pena
tags:
 - Tips
date: 2023-06-09
template: post
description: Es el mejor editor de textos, pero aprenderlo lleva mucho esfuerzo. Solamente tenés que aprender lo básico.

---

<img src="exit-vim.jpg"
  alt="La protagonista de La Llegada (Arrival) escribe en la pizarra ESC :q!" />

## Lo básico, esto si sabelo

Salir de vim es un meme, el meme mas verdadero que te va a pasar. Primero hay que
entender que vim tiene distintos modos, principalmente uno donde escribís,
*insert*, y otros donde ejecutas comandos, *normal* y *modo ex* (tiene más,
dijimos solo básico aca). Entonces apretas **Escape** para ir al modo normal
y después **:** (ahora estamos en modo ex), apretamos **q** para salir. Si tenés
cambios sin guardar, no vas a poder salir (aca esta el meme), entonces en vez de
**q** tenemos dos opciones o apretamos **wq** para guardar y después salir o **q!**
para forzar la salida.

Y si te sigue fallando, esto: **Escape :qa!**.

Todavía no terminamos lo básico. ¿Querés editar un archivo? Bueno vamos a tener
que ir al modo *insert*, esto es apretando **i**. Abajo a la izquierda te dice en
que modo estás, ante la duda apretás **escape**, vas al modo normal, y ahi **i**.

Una última cosa, desde el modo normal (no te voy a repetir como llegar ahí),
apretas **/** y escribís lo que quieras buscar más **enter** y con **n** vas al
siguiente resultado. No te olvides de **i** si querés editar.

## Un poco más avanzado, y lo bueno de vim

Todas esas letras tienen sentido, **q** es quitar, **w** es write (guardar), **a**
es all (todos), **i** viene de insertar, **n** de next (siguiente). Esto se repite
mucho, y de hecho en el modo normal la manipulación del texto es con los verbos
*delete* (que funciona como cortar en realidad) y *yank* que es copiar (viene de
[tirar un registro para su uso posterior](https://stackoverflow.com/questions/16757516/why-does-yank-have-the-meaning-of-copy-in-vim)).

Supongamos que queremos eliminar una palabra, nos paramos sobre la palabra en modo
normal y apretamos **dw**, esto es delete word (eliminar palabra) y si queres
eliminar una fila es **dd**, delete por 2. Ahora cuando lo que queremos es copiar
en vez de **d** presionamos **y** (yank). Ahora si queremos borrar dos palabras,
escribimos **d2w**, podemos también copiar lo que esta dentro de paréntesis con
**di(** y eliminar hasta la tercera vez que encontró una coma con **d3t,** (delete
3 un**t**il ",").

Todo esto lo podés practicar con un programa que suele venir instalado junto a
vim llamado [vimtutor](https://github.com/vim/vim/tree/master#documentation).

## Por qué hay tantos fanáticos, y lo malo de vim

vim es la evolución de vi (*vi* *im*proved). Y tiene su evolución en
[NeoVim](https://neovim.io/) que es lo que te recomiendo usar hoy en día.

Hace un tiempo en el mundo Unix hubo una
[guerra de editores](https://en.wikipedia.org/wiki/Editor_war) entre los usuarios
de vim y el otro editor popular, [emacs](https://www.gnu.org/software/emacs/).
A diferencia de vi, emacs no tiene evoluciones directas. La principal diferencia es
que en emacs no hay modos, siempre estas editando y para ejecutar comandos apretás
una combinación de teclas, como por ejemplo **Alt + W** para copiar o **Control +
Y** para pegar. Si, adivinaron, emacs no tiene sucesores porque ganó la guerra.

Todos los editores que vinieron después usan los atajos de teclado para ejecutar
comandos. Por eso hoy en día les digo que directamente usen
[VSCode](https://code.visualstudio.com/) o alguno de
[JetBrains](https://www.jetbrains.com/) y si realmente quieren perder el tiempo,
ambos tienen para instalar plugins con modos vim.

No me arrepiento para nada de usarlo día a día, sólo sepan que hay que invertir
mucho tiempo en memorizar todos esos comandos (no en la cabeza, sino en memoria
muscular) y su foco debería estar en otro lado. La gente que perdió mucho tiempo
se siente superior, aunque no lo sea. De ahí viene el fanatismo.

Si aún asi no logro convecerte que no vale la pena,
**bienvenido al lado oscuro**😎
