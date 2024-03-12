<?php

spl_autoload_register(function ($class) {
  // Reemplaza las barras invertidas por barras normales dentro de la variable $ClassPath (camino de clases)
  $classPath = str_replace('\\', '/', $class) . '.php';

  // Busca el archivo de la clase en la ruta especificada
  if (file_exists($classPath)) {
    require_once $classPath;
  }
});