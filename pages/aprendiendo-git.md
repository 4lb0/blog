---

title: Aprendiendo lo básico de git
tags:
 - Tips para Juniors 
 - Tips
 - Git
 - Programacion 
date: 2021-12-16
template: post
description: Git es una aplicación para el manejo del control de versiones. Aprendamos lo básico. 

---

<img src="git.svg" alt="Logo de git" />

[Git](https://git-scm.com/) es una aplicación de control de versiones. Asi como el botón de deshacer (Control+Z) del procesador de texto, git te permite volver hacia atrás sobre los cambios que guardaste al hacer *commit*. Pero lo mas importante es que permite compartir archivos y carpetas entre varias personas, y que cada cual haga sus cambios sin que uno pise los cambios de otro.

Lo primero que hay que hacer es abrir la consola y crear o ir a la carpeta que voy a trabajar. Luego ejecuto

    git init

Este comando inicializa el *repositorio*, que es el lugar donde tengo los archivos y carpetas que voy a compartir.
Una vez que hago mis cambios los tengo que guardar.

    git add .
    git commit -m "Resumen de los cambios"

## ¿Cómo comparto mi proyecto con otros?

En el caso que el repositorio ya este creado y este compartido en alguna plataforma como GitHub, Bitbucket o GitLab lo agregamos de la siguiente manera.

    git remote add origin https://github.com/mi-usuario/un-repo.git
    git fetch --all
    git checkout main

En la URL va la ruta de la plataforma. Idealmente se usa la de ssh (git@github.com:mi-usuario/un-repo.git) pero como es el primer tutorial lo dejamos pasar.
El nombre de la rama (o *branch*) principal es **main**, aunque históricamente se usó **master**.

Ahora llegó la hora de bajar los cambios que hicieron otras personas.

    git pull --rebase

Con esta línea me traigo los cambios. Luego con la siguiente línea los agregamos:

    git push origin main

Como el proyecto lo configuramos con *https* en vez de *ssh* nos va a pedir la contraseña cada vez que hagamos push.

## ¿Qué hago si cuando traigo los cambios me dice que hay un conflicto?

Me puede pasar que haya un conflicto, esto es que git detecta que otra persona y yo editamos la misma línea y no sabe cual es la que iría. Un conflicto se ve de la siguiente manera:

    Auto-merging README.md
    CONFLICT (content): Merge conflict in README.md
    error: could not apply 9676087... Add logo
    Resolve all conflicts manually, mark them as resolved with
    "git add/rm <conflicted_files>", then run "git rebase --continue".
    You can instead skip this commit: run "git rebase --skip".
    To abort and get back to the state before "git rebase", run "git rebase --abort".
    
Luego si ejecutamos `git status` podemos ver efectivamente cual es el o los archivos que hay que modificar.

    Unmerged paths:
      (use "git restore --staged <file>..." to unstage)
      (use "git add <file>..." to mark resolution)
      both modified:   README.md

Para poder solucionar el conflicto voy a editar los archivos que dice que modificamos los dos, en este caso README.md.

    <<<<<<< HEAD    
    BLOG_LOGO="😀" \    
    =======    
    BLOG_LOGO=@ \    
    >>>>>>> 9676087 (Add logo) 

Ahora veo cual es el cambio que tiene que ir, lo edito libremente. Hay que quitar las líneas que empizen con <<<<<, ===== y >>>>>. Quedaría por ejemplo algo asi:
    
    BLOG_LOGO="😀" \

Por último vamos a ejecutar los siguientes comandos para marcar los conflictos como solucionados.

    git add .
    git rebase --continue

## ¡Listo!

Bueno con esto podemos empezar a trabajar. Aunque no vimos muchas cosas, entre ellos lo mas importante que son las ramas (*branches*). Por ahora estamos manejando una Ferrari para ir al kiosco, pero tranquilos ya va a haber tiempo para complicar las cosas aún mas. Una vez que tengan este flujo internalizado y se sientan cómodos con git pueden avanzar.

Si te interesó y queres seguir aprendiendo el mejor recurso es el libro [Pro Git](https://git-scm.com/book/es/v2) que es gratis y en español.
