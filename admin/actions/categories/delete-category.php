<?php
require_once "../../../lib/utils/autoload.php";

$categoryId = $_GET['id'] ?? null;

try {
    $category = Category::getCategoryById($categoryId);
    if ($category === null) {
        die("Error: Categoría no encontrada.");
    }
    $category->deleteCategory();
    header("Location: ../../index.php?page=admin-categories");
    exit();
} catch (Exception $error) {
    die("No se pudo eliminar la categoría: " . $error->getMessage());
}
