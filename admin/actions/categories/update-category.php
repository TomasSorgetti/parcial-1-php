<?php
require_once "../../../lib/utils/autoload.php";

$categoryName = trim($_POST['name']);
$categoryPath = trim($_POST['path']);
$categoryId = $_POST['id'];

try {

    Category::updateCategory($categoryId, $categoryName, $categoryPath);

    Alert::add('success', "Categoría actualizada correctamente.");

    header("Location: ../../index.php?page=admin-categories");
    exit();
} catch (Exception $error) {
    Alert::add('danger', "No se pudo actualizar la categoría");
    header("Location: ../../index.php?page=admin-categories");
    exit();
}
