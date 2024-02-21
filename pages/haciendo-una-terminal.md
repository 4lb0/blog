---

title: Haciendo una terminal
tags:
 - Programacion
 - Prototipos
 - Proyectos
date: 2024-02-22
template: post
description: Una terminal es una app muy sencilla, solo recibe una entrada y devuelve una salida del shell, pero no, no es sencilla.
illustration: undraw

---

Uso la terminal todo el tiempo, mas que nada la abro en fullscreen y ejecuto un Tmux que se guarda automáticamente. Para eso uso la terminal de Ubuntu, [GNOME Terminal](https://help.gnome.org/users/gnome-terminal/stable/index.html.en). Todo venía bien hasta que tuve ganas de usar fuentes con [ligaduras, como por ejemplo la fuente FiraCode](https://github.com/tonsky/FiraCode).

Me propuse buscar alguna alternativa:

* [Alacritty](https://alacritty.org): no tiene la soporte para ligaduras.
* [iTerm2](https://iterm2.com) y [Warp](https://warp.dev/): solo soportan Mac.
* [kitty](https://sw.kovidgoyal.net/kitty/): no soporta bien Tmux.
* [GNOME Console](https://gitlab.gnome.org/GNOME/console): una alternativa light a gnome-terminal, tampoco tiene la soporte para ligaduras.
* [QTerminal](https://github.com/lxqt/qterminal): es una terminal de escritorio basado en Qt, ¡tiene la soporte para ligaduras! Pero no puedo pasarle un comando y que se mantenga abierto.

Ya que no estoy interesado en que tenga tabs, ni configuración ni nada raro me propuse a hacer una. ¿Qué tan difícil puede ser? Bueno por empezar, hay que parsear el input. Fácil. Excepto que el input no es sólo texto, sino cualquier tecla que apretas. Luego hay llamás al shell. No momento, al custom shell que tiene el usuario. Bien, esta en la variable SHELL del environment.

Ahora si, ejecutamos y tomamos el output y listo. No, hay que parsear los colores. Pero podríamos usar una librería como [VTE (Virtual Terminal Emulator)](https://gitlab.gnome.org/GNOME/vte). Ah no, no soporta ligaduras. Entonces hay que parsear algo como `\e[33;1m` y convertirlo en color de la letra o del fondo, o si es negrita o si esta subrayado. Todo eso hay que parsearlo a mano. Ah y eso no es suficiente, en realidad hay que hacer un master de pseudoterminal que se comunicará con un slave, esto lo podés hacer con [PTY](https://man7.org/linux/man-pages/man7/pty.7.html). Ah ¿y el scroll? ¿y el historial? Conclusión, no, no es para nada sencillo hacer una terminal. Tal vez algún otro día.
