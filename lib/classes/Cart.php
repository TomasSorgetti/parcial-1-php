<?php

class Cart
{

    public static function add(int $productId, int $quantity)
    {
        $product = Product::getProductById($productId);

        if ($product) {
            $_SESSION['cart'][$productId] = [
                'quantity' => $quantity,
                'title' => $product->getTitle(),
                'price' => number_format($product->getPrice() * $quantity, 2, '.', ''),
                'image' => $product->getImage(),
                'id' => $product->getId()
            ];
        }
    }

    public static function remove(int $productId)
    {
        unset($_SESSION['cart'][$productId]);
    }

    public static function update(int $productId, int $quantity)
    {
        if ($quantity < 1) {
            self::remove($productId);
            return;
        }
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
        $_SESSION['cart'][$productId]['price'] = number_format(Product::getProductById($productId)->getPrice() * $quantity, 2, '.', '');
    }

    public static function clear()
    {
        $_SESSION['cart'] = [];
    }

    public static function get()
    {
        return $_SESSION['cart'] ?? [];
    }

    public static function getTotal()
    {
        $total = 0;
        foreach (self::get() as $item) {
            $total += $item['price'];
        }
        return $total;
    }
}
