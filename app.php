<?php

require __DIR__ . '/vendor/autoload.php';

use Blog\DevServer;

setlocale(LC_ALL, 'es_AR.UTF-8');

(new DevServer)();
