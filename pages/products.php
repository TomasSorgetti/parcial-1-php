<?php 
    require_once "lib/classes/Product.php";

    $searchQuery = $_GET["search"] ?? "";
    $categoryQuery = $_GET["cat"] ?? "all";
    $orderQuery = $_GET["order"] ?? "price_asc";
    $pageQuery = intval($_GET["sec"] ?? 1);

    $responseProducts = Product::getAllProducts($searchQuery, $categoryQuery, $orderQuery, $pageQuery);

?>
<main>
    <section class="h-[60vh] flex flex-col justify-center items-center gap-8 bg-[url('assets/images/products_bg.png')] bg-center bg-no-repeat">
        <h1 class="text-5xl uppercase font-bold">Productos asdkj aklsdj klasjd kl</h1>
        <p>asdkj aklsdj klasjd kl asldkj aklsdj klasjd kl asldkj aklsdj klasjd klasdasd asd asd</p>
    </section>
    <section class=" max-w-[1280px] mx-auto">
        <div class="flex items-center justify-between py-4 border-b-1 border-[var(--primary-color)]">
            <h2>Destacados</h2>
            <input type="text" class="border-2 border-[var(--primary-color)]">
            <select name="" id="">
                <option selected >Ordenar por</option>
                <option value="price_asc">Mayor precio</option>
                <option value="price_desc">Menor precio</option>
                <option value="name_asc">Nombre A-Z</option>
                <option value="name_desc">Nombre Z-A</option>
            </select>
        </div>
        <div class="flex gap-4 justify-between mt-4">
            <aside class="w-full max-w-[300px] border-r-1 border-[var(--primary-color)]">
                <h3>Categorías</h3>
            </aside>
            <div class="flex flex-wrap gap-4">
                <?php 
            foreach ($responseProducts["products"] as $product) {
                echo("
                <div class='w-full max-w-[300px] border-1 border-[var(--light-dark-color)] rounded-md flex flex-col gap-2 min-h-[460px] shadow-md hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out'>
                    <div class='h-1/2 bg-gray-200 w-full flex justify-center items-center overflow-hidden rounded-t-md'>
                        <img src='img/products/" . $product->getImage() . "' alt='" . $product->getTitle() . "'>
                    </div>
                    <div class='p-4 h-1/2 flex flex-col justify-between'>
                        <div class='flex flex-col gap-2'>
                            <h3 class='font-bold'>" . $product->getTitle() . "</h3>
                            <p class='text-[var(--dark-text-color)]'>" . $product->getDescription() . "</p>
                            <p class='text-[var(--dark-text-color)]'>$ <span class='font-bold text-[var(--light-text-color)] text-2xl'>" . $product->getSale_price() . "</span></p>
                        </div>
                        <a class='text-[var(--light-text-color)] px-6 py-3 bg-[var(--primary-color)] rounded-full text-center uppercase font-bold' href='index.php?page=product&id=" . $product->getId() . "'>Comprar</a>
                    </div>
                </div>");
            }
            ?>
        </div>
    </div>
    </section>
</main>