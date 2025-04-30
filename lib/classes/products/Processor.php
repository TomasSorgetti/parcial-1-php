<?php
require_once 'Product.php';

class Processor extends Product {
    private $socket;
    private $cores;
    private $threads;

    public static function getAllProcessors($search, $socket, $cores, $threads): array {
        return [];
    }
};