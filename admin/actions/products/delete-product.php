<?php
require_once "../../../lib/utils/autoload.php";

$productId = $_GET['id'] ?? null;

try {
    $product = Product::getProductById($productId);

    if ($product === null) {
        throw new Exception("Error: Producto no encontrado.");
    }

    if ($product->getImage()) {
        Image::delete('../../../assets/images/products/', $product->getImage());
    }

    $product->deleteProduct();

    Alert::add('success', 'Producto eliminado correctamente.');

    header("Location: ../../index.php?page=admin-products");
    exit();
} catch (Exception $error) {
    Alert::add('danger', "No se pudo eliminar el producto");
    header("Location: ../../index.php?page=admin-products");
    exit();
}
