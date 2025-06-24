<?php
session_start();

function autoload($className)
{
    $file = __DIR__ . "/../classes/$className.php";

    if (file_exists($file)) return require_once $file;

    die("No se pudo cargar la clase $file");
}

spl_autoload_register("autoload");
