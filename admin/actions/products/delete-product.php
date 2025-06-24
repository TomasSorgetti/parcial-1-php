<?php
require_once "../../../lib/utils/autoload.php";

$productId = $_GET['id'] ?? null;

try {
    $product = Product::getProductById($productId);

    if ($product === null) {
        throw new Exception("Error: Producto no encontrado.");
    }

    Image::delete('../../../assets/images/products/', $product->getImage());

    $product->deleteProduct();

    header("Location: ../../index.php?page=admin-products");
    exit();
} catch (Exception $error) {
    die($error->getMessage());
}
