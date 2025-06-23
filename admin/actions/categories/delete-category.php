<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../../lib/classes/Database.php";
require_once "../../../lib/classes/Category.php";

// Validate category ID
$categoryId = $_GET['id'] ?? null;
if (!is_numeric($categoryId) || $categoryId <= 0) {
    die("Error: ID de categoría inválido.");
}

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