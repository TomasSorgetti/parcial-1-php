<?php 
    require_once "lib/classes/Product.php";

    $productId = $_GET["id"];

    $product = Product::getProductById($productId);
?>

<main class="mt-8">
    <section class="h-[50vh] flex flex-col justify-center items-center gap-8">
        <h1 class="text-5xl uppercase font-bold"><?=$product->getTitle()?></h1>
        <p><?=$product->getDescription()?></p>
    </section>
</main>