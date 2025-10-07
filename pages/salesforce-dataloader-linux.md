---

title: Salesforce Data Loader en Linux
tags:
 - Salesforce
date: 2023-06-12
template: post
description: No hay soporte oficial para Linux pero siendo una app hecha en Java funciona sin ningún problema. Te cuento los pasos para instalarla y como ejecutarla.

---

<img src="salesforce.svg" alt="Logo de Salesforce" />

Primero hay que [descargar el release](https://github.com/forcedotcom/dataloader/releases),
la última versión en **zip**. Lo extraemos y nos paramos sobre la carpeta creada.
Ejecutamos el siguiente comando, reemplazando por la versión correspondiente.

    java -cp dataloader-58.0.2.jar com.salesforce.dataloader.process.DataLoaderRunner

En caso de no tener instalado Java:

    sudo apt install default-jre

Si al ejecutarla tenemos un problema, instalar esta version de SWT:

    sudo apt install libswt-gtk-4-java

Como último paso podemos agregar al launcher, en el caso de Ubuntu de esta
manera. Primero descargamos el icono desde la Wikipedia:

    wget https://upload.wikimedia.org/wikipedia/commons/f/f9/Salesforce.com_logo.svg

Y creamos el archivo **salesforce.desktop** en `~/.local/share/applications/`

Cambiar la ruta por el lugar directorio donde esta descomprimido (en el ejemplo
esta en /apps/dataloader) y también la versión del archivo jar:

    [Desktop Entry]
    Name=Salesforce Data Loader
    Exec=java -cp /apps/dataloader/dataloader-58.0.2.jar com.salesforce.dataloader.process.DataLoaderRunner
    Icon=/apps/dataloader/Salesforce.com_logo.svg
    Terminal=false
    Type=Application
    Categories=Development;
