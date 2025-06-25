<?php
require_once "../../../lib/utils/autoload.php";

try {
    $id_category = trim($_POST['category']);
    $id_brand = trim($_POST['brand']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $stock = trim($_POST['stock']);
    $price = trim($_POST['price']);
    $offer_price = trim($_POST['offer_price']);
    $id = trim($_POST['id']);
    $tags = $_POST['tags'];

    $image = trim($_POST['image']); // Imagen actual

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $newImage = Image::upload('../../../assets/images/products/', $_FILES['image']);

        if ($newImage) {
            if (!empty($image)) {
                Image::delete('../../../assets/images/products/', $image);
            }
            $image = $newImage;
        }
    }

    Product::updateProductById($id, $id_category, $id_brand, $title, $image, $description, $stock, $price, $offer_price, $tags);

    header("Location: ../../index.php?page=admin-products");
    exit();
} catch (Exception $error) {
    die("No se pudo modificar el producto: " . $error->getMessage());
}
