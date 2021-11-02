---

title: Un simple reloj con Petite Vue
tags:
 - vue
 - ejemplos
 - petite-vue
date: 2021-10-26
template: post
description: Un ejemplo muy corto de Petite Vue que sirve para mostrar la hora en una pestaña del navegador.

---

![Screenshot de la web del reloj](images/screenshot-time-web.png)

Muchas veces cuando estoy en una call con dos pantallas me queda bloqueado el reloj de Ubuntu. Hay muchas páginas que te muestran la hora pero lo que yo quería era que me la mostrara en el title, asi dejaba la pestaña abierta en Firefox y no necesitaba nada mas.

Aproveché la oportunidad para practicar Vue y me topé con la versión light: [PetiteVue](https://github.com/vuejs/petite-vue#readme).

La lógica por supuesto es muy sencilla, solamente hay que tener en cuenta agregar un 0 como prefijo para los minutos y segundos, asi queda 23:00:05 y no 23:0:5.
El resto es actualizar la propiedad `time` y el título (`document.title`).

```
const app = {
  time: '',
  update () {
    const zero = (number) => {
      return number < 10 ? '0' + number : number
    }
    const date = new Date()
    this.time = date.getHours() + ':' + zero(date.getMinutes()) + ':' + zero(date.getSeconds())
    document.title = this.time
  },
  setUp () {
    this.update()
    setInterval(this.update, 1000)
  }
}
PetiteVue.createApp(app).mount()
```

El HTML queda asi

```
<main v-cloak @mounted="setUp()">
  <h1 class="center">{{ time }}</h1>
</main>
<script src="https://unpkg.com/petite-vue@0.3.0/dist/petite-vue.iife.js"></script>
<script src="app.js"></script>
```

Se puede ver funcionando en [time.albo.ar](https://time.albo.ar) y el código entero lo podes ver en mi GitHub [4lb0/time](https://github.com/4lb0/time).
