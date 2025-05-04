<?php 
    require_once "lib/classes/Product.php";
    require_once "lib/classes/Category.php";
    require_once "lib/utils/cutText.php";

    $searchQuery = $_GET["search"] ?? "";
    $categoryQuery = $_GET["cat"] ?? "all";
    $orderQuery = $_GET["order"] ?? "price_asc";
    $pageQuery = intval($_GET["sec"] ?? 1);

    $responseProducts = Product::getAllProducts($searchQuery, $categoryQuery, $orderQuery, $pageQuery);
    $categories = Category::getAllCategories();
?>
<main>
    <section class="h-[60vh] text-center flex flex-col justify-center items-center gap-8 bg-[url('assets/images/products_bg.png')] bg-center bg-no-repeat">
        <h1 class="text-5xl uppercase font-bold max-w-[700px]">Encendé la Chispa en Tu Máquina Soñada</h1>
        <p class=" max-w-[600px]">Tu PC es más que hardware, es una extensión de ti. Explorá nuestra colección de componentes de élite. ¡Encendé la chispa!</p>
    </section>
    <section class=" max-w-[1280px] mx-auto">
        <div class="flex items-center justify-between py-4 border-b-1 border-[var(--primary-color)]">
            <h2 class="uppercase font-bold text-2xl">Destacados</h2>
            <input type="text" class="border-2 border-[var(--primary-color)]">
            <div >
                <p>Ordenar por</p>
                <a href="index.php?page=products&order=price_desc">Mayor precio</a>
                <a href="index.php?page=products&order=price_asc">Menor precio</a>
                <a href="index.php?page=products&order=name_asc">Nombre A-Z</a>
                <a href="index.php?page=products&order=name_desc">Nombre Z-A</a>
            </div>
        </div>
        <div class="flex gap-4 justify-between mt-4">
            <aside class="w-full max-w-[300px] p-4 border-r-1 border-[var(--light-dark-color)]">
                <h3 class="uppercase font-bold text-1xl">Categorías</h3>
                <ul class="flex flex-col gap-2 mt-2">
                    <li><a href="index.php?page=products&cat=all" class='hover:text-[var(--primary-color)] text-[var(--dark-text-color)]'>Todos los productos</a></li>
                    <?php 
                        foreach ($categories as $category) {
                            echo("<li><a class='hover:text-[var(--primary-color)] text-[var(--dark-text-color)]' href='index.php?page=products&cat=" . $category->getId() . "'>" . $category->getName() . "</a></li>");
                        }
                    ?>
                </ul>
            </aside>
            <div class="w-full flex flex-wrap gap-4">
                <?php 
                if(count($responseProducts["products"]) === 0) {
                    echo("<p class='mt-10 text-[var(--dark-text-color)] w-full text-center'>No se encontraron productos</p>");
                }else{
                    foreach ($responseProducts["products"] as $product) {
                        echo("
                            <div class='w-full max-w-[300px] border-1 border-[var(--light-dark-color)] cursor-pointer rounded-md flex flex-col gap-2 min-h-[460px] shadow-md hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out group'>
                                <div class='h-1/2 w-full flex justify-center items-center overflow-hidden rounded-t-md'>
                                    <img src='assets/images/products/" . $product->getImage() . "' alt='" . $product->getTitle() . "' class='group-hover:scale-110 transition-all duration-500 ease-in-out object-cover'>
                                </div>
                                <div class='p-4 h-1/2 flex flex-col justify-between'>
                                    <div class='flex flex-col gap-2'>
                                        <h3 class='font-bold'>" . $product->getTitle() . "</h3>
                                        <p class='text-[var(--dark-text-color)]'>" . cutText($product->getDescription(), 50) . "</p>
                                        <p class='text-[var(--dark-text-color)]'>$ <span class='font-bold text-[var(--light-text-color)] text-2xl'>" . $product->getSale_price() . "</span></p>
                                    </div>
                                    <a class='text-[var(--light-text-color)] px-6 py-3 bg-[var(--primary-color)] rounded-full text-center uppercase font-bold' href='index.php?page=product&id=" . $product->getId() . "'>ver producto</a>
                                </div>
                            </div>"
                        );
                    }
                }
            ?>
        </div>
    </div>
    </section>
</main>