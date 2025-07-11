<?php
require_once "../../utils/autoload.php";

$productId = intval($_POST['productId']) ?? null;
$quantity = intval($_POST['quantity']) ?? 1;

try {
    Cart::add($productId, $quantity);

    header('Location: ../../../index.php?page=product&id=' . $productId . '');
    exit();
} catch (Exception $error) {
    echo $error->getMessage();
}
