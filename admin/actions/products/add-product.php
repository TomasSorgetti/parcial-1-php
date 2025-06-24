<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);

require_once "../../../lib/classes/Database.php";
require_once "../../../lib/classes/Product.php";
require_once "../../../lib/classes/Image.php";

$image = "";

try {
    $image = Image::upload('../../../assets/images/products/', $_FILES['image']);

    if (empty($image)) {
        throw new Exception('Error al subir la imagen');
    }

    $id_category = trim($_POST['category']);
    $id_brand = trim($_POST['brand']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $stock = trim($_POST['stock']);
    $price = trim($_POST['price']);
    $offer_price = trim($_POST['offer_price']);

    Product::insertProduct($id_category, $id_brand, $title, $image, $description, $stock, $price, $offer_price);

    header("Location: ../../index.php?page=admin-products");
    exit();
} catch (Exception $error) {
    $deleteImage = Image::delete('../../../assets/images/products/', $image);
    die("No se pudo agregar el producto: " . $error->getMessage());
}
