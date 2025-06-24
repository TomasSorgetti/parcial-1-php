<?php
require_once "../../../lib/utils/autoload.php";

$categoryName = trim($_POST['name']);
$categoryPath = trim($_POST['path']);
$categoryId = $_POST['id'];

try {

    Category::updateCategory($categoryId, $categoryName, $categoryPath);

    header("Location: ../../index.php?page=admin-categories");
    exit();
} catch (Exception $error) {
    die("No se pudo eliminar la categoría: " . $error->getMessage());
}
