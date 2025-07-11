<?php
require_once "../../utils/autoload.php";

$productId = intval($_GET['productId']) ?? null;
$page = $_GET['page'] ?? null;

try {
    Cart::remove($productId);

    if ($page == 'checkout') {
        header("Location: ../../../index.php?page=checkout");
        exit();
    }
    header("Location: ../../../index.php?page=products");
    exit();
} catch (Exception $error) {
    echo $error->getMessage();
}
