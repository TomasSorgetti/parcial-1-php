<?php
require_once "../../../lib/classes/Database.php";
require_once "../../../lib/classes/Brand.php";

$brandName = trim($_POST['name']);

try {
    Brand::insertBrand($brandName);
    header("Location: ../../index.php?page=admin-brands");
    exit();
} catch (Exception $error) {
    die("No se pudo agregar la Marca: " . $error->getMessage());
}
