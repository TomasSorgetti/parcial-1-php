<?php
require_once "../../../lib/utils/autoload.php";

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
    $tags = $_POST['tags'];

    Product::insertProduct($id_category, $id_brand, $title, $image, $description, $stock, $price, $offer_price, $tags);

    Alert::add('success', 'Producto agregado correctamente.');
    header("Location: ../../index.php?page=admin-products");
    exit();
} catch (Exception $error) {
    $deleteImage = Image::delete('../../../assets/images/products/', $image);
    Alert::add('danger', "No se pudo agregar el producto");
    header("Location: ../../index.php?page=admin-products");
    exit();
}
