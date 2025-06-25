<?php
require_once "../../../lib/utils/autoload.php";

$brandName = trim($_POST['name']);
$brandId = $_POST['id'];

try {
    Brand::updateBrand($brandId, $brandName);

    Alert::add('success', "Marca actualizada correctamente.");

    header("Location: ../../index.php?page=admin-brands");
    exit();
} catch (Exception $error) {
    Alert::add('danger', "No se pudo actualizar la Marca");
    header("Location: ../../index.php?page=admin-brands");
    exit();
}
