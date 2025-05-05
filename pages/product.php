<?php 
    require_once "lib/classes/Product.php";

    $productId = $_GET["id"];

    $product = Product::getProductById($productId);
?>

<main class="mt-8">
    <section class="flex flex-col justify-center items-center gap-8 max-w-[1280px] mx-auto my-32 px-4 lg:flex-row lg:px-0">
        <img src="assets/images/products/<?=$product->getImage()?>" alt="<?=$product->getTitle()?>" class="lg:p-8 lg:w-1/2" draggable="false" loading="lazy">  
        <div class="flex flex-col gap-4 justify-center items-center text-center max-w-[700px] lg:text-left lg:w-1/2 lg:p-8 lg:items-start">
            <h1 class="uppercase font-bold text-3xl lg:text-5xl"><?=$product->getTitle()?></h1>
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