<?php
require_once "../../../lib/utils/autoload.php";

$brandName = trim($_POST['name']);

try {
    Brand::insertBrand($brandName);

    Alert::add('success', "Marca agregada correctamente.");

    header("Location: ../../index.php?page=admin-brands");
    exit();
} catch (Exception $error) {
    if (strpos($error->getMessage(), 'Duplicate entry') !== false) {
        Alert::add('danger', "Ya existe una marca con el mismo nombre.");
    } else {
        Alert::add('danger', "No se pudo agregar la marca");
    }
    header("Location: ../../index.php?page=admin-brands");
    exit();
}
