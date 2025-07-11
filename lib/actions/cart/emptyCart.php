<?php
require_once "../../utils/autoload.php";

try {
    Cart::clear();

    header("Location: ../../../index.php?page=products");
    exit();
} catch (Exception $error) {
    echo $error->getMessage();
}
