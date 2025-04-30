<?php
require_once 'Product.php';

class Motherboard extends Product {
    private $brand;
    private $socket;

    public static function getAllMotherboards($search): array {
        return [];
    }
};