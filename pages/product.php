<?php 
    require_once "lib/classes/Product.php";

    $productId = $_GET["id"];

    $product = Product::getProductById($productId);
?>

<main class="mt-8">
    <section class="flex justify-center items-start gap-8 max-w-[1280px] mx-auto my-32">
        <img src="assets/images/products/<?=$product->getImage()?>" alt="<?=$product->getTitle()?>" class="w-1/2 p-8" draggable="false" loading="lazy">  
        <div class="w-1/2 flex flex-col gap-4 justify-center items-start p-8">
            <h1 class="text-5xl uppercase font-bold"><?=$product->getTitle()?></h1>
            <p class="text-[var(--dark-text-color)]"><?=$product->getDescription()?></p>
            <div class="w-full h-[1px] bg-[var(--primary-color)]"></div>
            <p class="text-[var(--dark-text-color)]">Precio especial <span class="font-bold text-[var(--primary-color)] text-3xl">$<?=$product->getSale_price()?></span></p>
            <div class="w-4/5 h-[1px] bg-[var(--primary-color)]"></div>
            <p class="text-[var(--dark-text-color)]">12 cuotas fijas de <span class="font-bold text-2xl text-[var(--dark-text-color)]">$<?=$product->getList_price()/12 + ($product->getList_price() % 12 > 0 ? 1 : 0) ?></span></p>
            <p class="text-[var(--dark-text-color)]">Precio de lista <span class="font-bold text-2xl text-[var(--dark-text-color)]">$<?=$product->getList_price()?></span></p>
            <a href="#" class="text-[var(--light-text-color)] px-6 py-3 bg-[var(--primary-color)] rounded-full text-center uppercase font-bold">Agregar al carrito</a>
        </div>
    </section>
</main>