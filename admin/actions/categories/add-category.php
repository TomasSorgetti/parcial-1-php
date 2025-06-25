<?php
require_once "../../../lib/utils/autoload.php";

$categoryName = trim($_POST['name']);
$categoryPath = trim($_POST['path']);

try {
    Category::insertCategory($categoryName, $categoryPath);

    Alert::add('success', "Categoría agregada correctamente.");

    header("Location: ../../index.php?page=admin-categories");
    exit();
} catch (Exception $error) {
    Alert::add('danger', "No se pudo agregar la categoría");
    header("Location: ../../index.php?page=admin-categories");
    exit();
}
