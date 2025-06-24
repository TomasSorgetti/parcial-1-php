<?php
require_once "../../../lib/utils/autoload.php";

$brandName = trim($_POST['name']);
$brandId = $_POST['id'];

try {
    Brand::updateBrand($brandId, $brandName);

    header("Location: ../../index.php?page=admin-brands");
    exit();
} catch (Exception $error) {
    die("No se pudo modificar la Marca: " . $error->getMessage());
}
