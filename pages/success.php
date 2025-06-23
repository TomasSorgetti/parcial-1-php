<?php
require_once "lib/classes/Product.php";

$procesador = Product::getProductById($_POST["processor"]);
$ram = Product::getProductById($_POST["ram"]);
$motherboard = Product::getProductById($_POST["motherboard"]);

$totalPrice = $procesador->getPrice() + $ram->getPrice() + $motherboard->getPrice();
?>

<main>
    <section class="text-center flex flex-col justify-center items-center gap-8 my-32">
        <h1 class="uppercase font-bold text-5xl">Gracias por tu compra</h1>
        <p class="text-[var(--dark-text-color)]">Tu compra ha sido realizada con exito.</p>
    </section>
    <section class="max-w-[1200px] mx-auto p-4 flex flex-col gap-8 items-center text-center md:text-left md:items-start md:p-8 lg:p-0">
        <p class="font-bold text-3xl uppercase">Total: <span class="text-[var(--primary-color)] font-bold text-4xl uppercase">$<?= $totalPrice ?></span></p>
        <h2 class="font-bold text-3xl uppercase">Tu orden es:</h2>
        <ul class="flex justify-center flex-wrap gap-4 my-8 md:justify-start">
            <li class="w-[300px] border-1 border-[var(--light-dark-color)] flex flex-col items-start justify-between py-6 px-4 rounded-md gap-4">
                <div>
                    <h3 class="uppercase font-bold text-[var(--dark-text-color)]"><?= $procesador->getTitle() ?></h3>
                    <p class="text-[var(--light-text-color)] text-3xl font-bold mt-4">$<?= $procesador->getPrice() ?></p>
                </div>
                <img src="assets/images/products/<?= $procesador->getImage() ?>" alt="<?= $procesador->getTitle() ?>" draggable="false" loading="lazy">
            </li>
            <li class="w-[300px] border-1 border-[var(--light-dark-color)] flex flex-col items-start justify-between py-6 px-4 rounded-md gap-4">
                <div>
                    <h3 class="uppercase font-bold text-[var(--dark-text-color)]"><?= $ram->getTitle() ?></h3>
                    <p class="text-[var(--light-text-color)] text-3xl font-bold mt-4">$<?= $ram->getPrice() ?></p>
                </div>
                <img src="assets/images/products/<?= $ram->getImage() ?>" alt="<?= $ram->getTitle() ?>" draggable="false" loading="lazy">
            </li>
            <li class="w-[300px] border-1 border-[var(--light-dark-color)] flex flex-col items-start justify-between py-6 px-4 rounded-md gap-4">
                <div>
                    <h3 class="uppercase font-bold text-[var(--dark-text-color)]"><?= $motherboard->getTitle() ?></h3>
                    <p class="text-[var(--light-text-color)] text-3xl font-bold mt-4">$<?= $motherboard->getPrice() ?></p>
                </div>
                <img src="assets/images/products/<?= $motherboard->getImage() ?>" alt="<?= $motherboard->getTitle() ?>" draggable="false" loading="lazy">
            </li>
        </ul>
    </section>
</main>