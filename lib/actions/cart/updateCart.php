<?php
require_once "../../utils/autoload.php";

$productId = intval($_GET['productId']) ?? null;
$quantity = intval($_GET['quantity']) ?? 1;
$add = $_GET['add'] ?? 'false';
$page = $_GET['page'] ?? null;

try {
    if ($add === 'true') {
        Cart::update($productId, $quantity + 1);
    } else {
        Cart::update($productId, $quantity - 1);
    }

    if ($page == 'checkout') {
        header("Location: ../../../index.php?page=checkout");
        exit();
    }

    header("Location: ../../../index.php?page=products");
    exit();
} catch (Exception $error) {
    echo $error->getMessage();
}
