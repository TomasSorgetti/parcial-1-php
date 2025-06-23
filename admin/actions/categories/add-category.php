<?php
require_once "../../../lib/classes/Database.php";
require_once "../../../lib/classes/Category.php";

$categoryName = trim($_POST['name']);
$categoryPath = trim($_POST['path']);

try {
    Category::insertCategory($categoryName, $categoryPath);
    header("Location: ../../index.php?page=admin-categories");
    exit();
} catch (Exception $error) {
    die("No se pudo agregar la categoría: " . $error->getMessage());
}
