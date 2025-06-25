<?php
require_once "../../../lib/utils/autoload.php";

$brandName = trim($_POST['name']);

try {
    Brand::insertBrand($brandName);

    Alert::add('success', "Marca agregada correctamente.");

    header("Location: ../../index.php?page=admin-brands");
    exit();
} catch (Exception $error) {
    Alert::add('danger', "No se pudo agregar la Marca");
    header("Location: ../../index.php?page=admin-categories");
    exit();
}
