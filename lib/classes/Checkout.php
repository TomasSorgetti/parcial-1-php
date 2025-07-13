<?php
class Checkout
{

    public static function insert(array $purcheaseData, array $detailsData)
    {
        $query = "INSERT INTO purchases VALUES (NULL, :user_id, :date, :amount)";
        $params = [
            ':user_id' => $purcheaseData['user_id'],
            ':date' => $purcheaseData['date'],
            ':amount' => $purcheaseData['amount']
        ];

        Database::execute($query, $params);

        $insertId = Database::getLastInsertId();

        foreach ($detailsData as $detail) {
            $query = "INSERT INTO product_purchase VALUES (NULL, :purchase_id, :product_id, :quantity)";
            $params = [
                ':purchase_id' => $insertId,
                ':product_id' => $detail['product_id'],
                ':quantity' => $detail['quantity']
            ];
            Database::execute($query, $params);
        }

        return $insertId;
    }
}
