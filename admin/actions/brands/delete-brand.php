<?php
require_once "../../../lib/classes/Database.php";
require_once "../../../lib/classes/Brand.php";

$brandId = $_GET['id'] ?? null;

try {
    $brand = Brand::getBrandById($brandId);
    if ($brand === null) {
        die("Error: Marca no encontrada.");
    }
    $brand->deleteBrand();
    header("Location: ../../index.php?page=admin-brands");
    exit();
} catch (Exception $error) {
    die("No se pudo eliminar la Marca: " . $error->getMessage());
}
