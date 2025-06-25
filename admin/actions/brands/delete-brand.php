<?php
require_once "../../../lib/utils/autoload.php";

$brandId = $_GET['id'] ?? null;

try {
    $brand = Brand::getBrandById($brandId);
    if ($brand === null) {
        die("Error: Marca no encontrada.");
    }
    $brand->deleteBrand();

    Alert::add('success', "Marca eliminada correctamente.");

    header("Location: ../../index.php?page=admin-brands");
    exit();
} catch (Exception $error) {
    Alert::add('danger', $error->getMessage());
    header("Location: ../../index.php?page=admin-brands");
    exit();
}
