<?php
require_once "../../../lib/utils/autoload.php";

$categoryId = $_GET['id'] ?? null;

try {
    $category = Category::getCategoryById($categoryId);
    if ($category === null) {
        die("Error: Categoría no encontrada.");
    }
    // TODO => cambiar a metodo estatico y evitar el getCategoryById
    $category->deleteCategory();

    Alert::add('success', "Categoría eliminada correctamente.");

    header("Location: ../../index.php?page=admin-categories");
    exit();
} catch (Exception $error) {
    Alert::add('danger', $error->getMessage());
    header("Location: ../../index.php?page=admin-categories");
    exit();
}
