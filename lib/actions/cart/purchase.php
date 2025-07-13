<?php
require_once "../../utils/autoload.php";

try {
    $products = Cart::get();
    $userId = Auth::getUserId();

    if (!empty($userId)) {
        if (empty($products)) {
            header("Location: ../../../index.php?page=checkout");
            Alert::add('danger', "No hay productos que comprar.");
            exit();
        }
        $purcheaseData = [
            'user_id' => $userId,
            'date' => date('Y-m-d H:i:s'),
            'amount' => Cart::getTotal()
        ];

        $detail = [];

        foreach ($products as $key => $value) {
            $detail[$key] = [
                'product_id' => $value['id'],
                'quantity' => $value['quantity']
            ];
        }

        Checkout::insert($purcheaseData, $detail);
        Cart::clear();
        Alert::add('success', "Compra realizada con exito.");
        header("Location: ../../../index.php?page=profile");
        exit();
    } else {
        Alert::add('danger', "Sesión caducada.");
        header("Location: ../../../index.php?page=signin");
        exit();
    }
} catch (Exception $error) {
    Alert::add('danger', "No se pudo realizar la compra.");
    header("Location: ../../../index.php?page=checkout");
    exit();
}
