<?php

class Purchase
{

    public static function getByUserId(int $user_id): array
    {
        $query = "
        SELECT purchases.id, purchases.date, purchases.amount, 
        GROUP_CONCAT(CONCAT(product_purchase.quantity, 'x', product.title)) as detail 
        FROM purchases 
        JOIN product_purchase ON purchases.id = product_purchase.purchase_id
        JOIN product ON product_purchase.product_id = product.id
        WHERE user_id = :user_id 
        GROUP BY purchases.id
        ";
        $params = [
            ':user_id' => $user_id
        ];

        $purchases = Database::execute($query, $params);

        return $purchases ?? [];

        return [];
    }
}
