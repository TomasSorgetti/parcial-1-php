<?php
require_once 'lib/classes/Product.php';
$processors = Product::getProductsByCategory(1);
$rams = Product::getProductsByCategory(2);
$mothers = Product::getProductsByCategory(3);

?>

<main class="my-32">
    <section>
        <h1 class="uppercase font-bold text-3xl text-center lg:text-5xl">Armá tu pc</h1>
        <form id="build-form" action="index.php?page=success" method="POST" class="flex flex-col gap-8 items-start mt-4 w-full max-w-[500px] mx-auto p-4">
            <div class="flex flex-col gap-2 items-start w-full lg:flex-row lg:gap-4">
                <!-- Name -->
                <div class="flex flex-col items-start w-full relative">
                    <label for="name">Nombre completo:</label>
                    <input type="text" name="name" id="name" placeholder="Juan Perez" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                    <small id="name-error" class="h-4 absolute left-0 -bottom-4 text-red-600"></small>
                </div>

                <!-- Email -->
                <div class="flex flex-col items-start w-full relative">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" placeholder="axz@mail.com" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                    <small id="email-error" class="h-4 absolute left-0 -bottom-4 text-red-600"></small>
                </div>
            </div>

            <!-- Processor -->
            <div class="flex flex-col items-start w-full relative">
                <label for="processor">Procesador:</label>
                <select name="processor" id="processor" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                    <option value="" selected>Elije un procesador...</option>
                    <?php foreach ($processors as $processor): ?>
                        <option value="<?= $processor->getId() ?>"><?= htmlspecialchars($processor->getTitle()) ?></option>
                    <?php endforeach; ?>
                </select>
                <small id="processor-error" class="h-4 absolute left-0 -bottom-4 text-red-600"></small>
            </div>

            <!-- Memory -->
            <div class="flex flex-col items-start w-full relative">
                <label for="ram">Memoria RAM:</label>
                <select name="ram" id="ram" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                    <option value="" selected>Elije una memoria...</option>
                    <?php foreach ($rams as $ram): ?>
                        <option value="<?= $ram->getId() ?>"><?= htmlspecialchars($ram->getTitle()) ?></option>
                    <?php endforeach; ?>
                </select>
                <small id="ram-error" class="h-4 absolute left-0 -bottom-4 text-red-600"></small>
            </div>

            <!-- Motherboard -->
            <div class="flex flex-col items-start w-full relative">
                <label for="motherboard">Motherboard:</label>
                <select name="motherboard" id="motherboard" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                    <option value="" selected>Elije una motherboard...</option>
                    <?php foreach ($mothers as $mother): ?>
                        <option value="<?= $mother->getId() ?>"><?= htmlspecialchars($mother->getTitle()) ?></option>
                    <?php endforeach; ?>
                </select>
                <small id="motherboard-error" class="h-4 absolute left-0 -bottom-4 text-red-600"></small>
            </div>

            <input id="buildButton" type="submit" value="Armar PC" class="w-full h-[48px] bg-[var(--primary-color)] text-white cursor-pointer hover:bg-[var(--alter-color)]">
        </form>
    </section>
</main>