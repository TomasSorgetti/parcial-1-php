<?php 
    require_once 'lib/classes/Product.php'; 
    $processors = Product::getProductsByCategory(1);
    $rams = Product::getProductsByCategory(2);
    $mothers = Product::getProductsByCategory(3);

?>

<main class="mt-32">
    <section>
        <h1 class="uppercase font-bold text-3xl">Armá tu pc</h1>
        <form action="index.php?page=success" method="POST" class="flex flex-col gap-4 items-start mt-4 w-full max-w-[500px] p-4">
            <div class="flex flex-col gap-2 items-start w-full">
                <label for="procesador" >Procesador:</label>
                <select name="procesador" id="procesador" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)]">
                    <option selected >Elije un procesador...</option>
                    <?php foreach($processors as $processor) : ?>
                        <option value="<?= $processor->getId() ?>"><?= $processor->getTitle() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex flex-col gap-2 items-start w-full">
                <label for="ram" >Memoria RAM:</label>
                <select name="ram" id="ram" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)]">
                    <option selected>Elije una memoria...</option>
                    <?php foreach($rams as $ram) : ?>
                        <option value="<?= $ram->getId() ?>"><?= $ram->getTitle() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex flex-col gap-2 items-start w-full">
                <label for="motherboard" >Motherboard:</label>
                <select name="motherboard" id="motherboard" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)]">
                    <option selected>Elije una motherboard...</option>
                    <?php foreach($mothers as $mother) : ?>
                        <option value="<?= $mother->getId() ?>"><?= $mother->getTitle() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="submit" value="Armar pc" class="w-full h-[48px] bg-[var(--primary-color)] text-white cursor-pointer hover:bg-[var(--alter-color)]">
        </form>
    </section>
</main>