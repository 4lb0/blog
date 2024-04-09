---

title: Guía para subir webs a Hosting o VPS
tags:
 - Tips
date: 2024-04-08
template: post
description: Esta guía ofrece un recorrido práctico por los fundamentos del alojamiento web, cubriendo desde la selección de un servicio adecuado hasta la implementación efectiva de sitios web en servidores o VPS.
illustration: going_up

---

Desde hace dos décadas me dedico al desarrollo web. En aquel entonces, no contábamos con herramientas de DevOps, ni con servicios como AWS o Vercel. La práctica común era la carga manual de archivos mediante FTP, un proceso que se veía limitado por la imposibilidad de comprimir archivos en formato zip, dada la falta de herramientas para su descompresión. Además, la lentitud inherente al protocolo FTP hacía que la carga inicial de archivos pudiera extenderse por una hora. Aunque el panorama tecnológico ha evolucionado, los principios fundamentales se mantienen.

## Aviso

Esta guía es básica, fue redactada durante una noche de insomnio. Contiene simplificaciones de ciertos conceptos, por lo que no es adecuada como material de estudio para certificaciones en AWS. Sin embargo, puede ser útil como introducción a los aspectos esenciales del alojamiento web, facilitando la búsqueda de información adicional y minimizando las consultas en este foro.

## Servidor, hosting y VPS

Comenzaremos con los conceptos básicos. Un servidor es un equipo informático sin periféricos como monitor, conectado a Internet, que suele disponer de alta capacidad de procesamiento y almacenamiento. Al contratar un servicio, se obtiene acceso a una fracción de estos recursos. En el caso de los servicios de hosting compartido, esta fracción es compartida con otros usuarios, lo que puede afectar el rendimiento de su sitio web si otro alojado en el mismo servidor experimenta altos volúmenes de tráfico. Por otro lado, un VPS (Servidor Privado Virtual) asigna recursos de manera exclusiva, a excepción de aquellos utilizados por el sistema operativo.

## Dominios y DNS

La estructura de Internet se basa en la conversión de nombres de dominio (por ejemplo, `miweb.com`) en direcciones IP a través del sistema de DNS (Sistema de Nombres de Dominio), lo que permite que las solicitudes lleguen al servidor adecuado. Aunque no es estrictamente necesario poseer un dominio, su adquisición es recomendada por razones de practicidad y profesionalismo.

## Implementación de sitios web

### Sitios estáticos o con JavaScript del lado del cliente

Estos pueden alojarse en plataformas como GitHub Pages, Vercel o Netlify, muchas de las cuales ofrecen servicios gratuitos. Es esencial familiarizarse con la configuración específica de cada plataforma para asegurar una implementación exitosa.

### Aplicaciones con Node.js

Para alojar aplicaciones que utilizan JavaScript en el servidor, es necesario configurar un entorno con servidores web como Nginx y gestionar procesos con herramientas como PM2. Esto implica la instalación y configuración de bases de datos y otros servicios necesarios, así como la gestión de la seguridad y el rendimiento del servidor.

### Sitios PHP

La mayoría de los servicios de hosting ofrecen soporte para PHP, lo que simplifica la implementación de sitios desarrollados en este lenguaje.

### Backend en otros lenguajes

Para tecnologías distintas a JavaScript y PHP, se debe adaptar la configuración del servidor para soportar el entorno de ejecución específico.

### Aplicaciones dockerizadas

Para proyectos que utilizan contenedores Docker, se recomienda el uso de servicios de orquestación de contenedores en la nube, aunque también es posible la implementación en un VPS con Docker instalado.

Es importante guiar a los clientes en la elección del servicio de alojamiento adecuado, asesorándolos sobre las distintas opciones y precios, para que la responsabilidad en caso de problemas recaiga en el proveedor elegido.

Esta guía ofrece una visión general de los aspectos fundamentales para la implementación de sitios web, con el objetivo de facilitar el proceso y minimizar las dificultades iniciales.

## Referencias

1. Un servidor también puede operar dentro de una red local sin acceso a Internet.
2. Aunque el acceso SSH es común, algunos servicios de hosting permiten la gestión a través de interfaces gráficas de usuario.
3. Para servicios de correo electrónico, se recomienda contratar proveedores especializados y configurarlos bajo su propio dominio.
4. Para más información sobre la implementación de contenedores en AWS: [AWS Containers](https://aws.amazon.com/getting-started/hands-on/deploy-docker-containers/).
