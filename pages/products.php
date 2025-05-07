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
    <section class="h-[70vh] text-center flex flex-col justify-center items-center gap-8 bg-[url('assets/images/products_bg.png')] bg-center bg-no-repeat px-4 md:px-8 lg:px-0">
        <h1 class="uppercase font-bold max-w-[700px] text-3xl md:text-4xl lg:text-5xl">Encendé la Chispa en Tu Máquina Soñada</h1>
        <p class=" max-w-[600px]">Tu PC es más que hardware, es una extensión de ti. Explorá nuestra colección de componentes de élite. ¡Encendé la chispa!</p>
    </section>
    <section class=" max-w-[1280px] mx-auto">
        <div class="flex flex-col gap-4 justify-center text-center py-4 border-b-1 border-[var(--primary-color)] lg:flex-row lg:justify-between lg:items-end lg:text-left">
            <h2 class="uppercase font-bold text-2xl w-full lg:max-w-[450px]">
                <?php 
                if ($categoryQuery == "all") {
                    echo("Todos los productos");
                } else {
                    echo( $categories[$categoryQuery - 1]->getName());
                }
                ?>
            </h2>
            <form id="filtersForm" method="GET" action="index.php" class="flex gap-4 items-end justify-between w-full px-4 lg:px-0">
                <input type="hidden" name="page" value="products">
                
                <!-- SearchBar -->
                <input
                    type="text"
                    id="searchInput"
                    name="search"
                    placeholder="Buscar producto..."
                    value="<?= htmlspecialchars($searchQuery ?? '') ?>"
                    class="border-1 border-[var(--primary-color)] p-2 rounded-md w-full max-w-[400px]"
                />
                
                <!-- Order -->
                <div class="flex flex-col items-start">
                    <label for="orderSelect" class="text-sm">Ordenar por</label>
                    <select name="order" id="orderSelect" class="border-1 p-2 rounded-md border-[var(--primary-color)] bg-[var(--background-color)] text-[var(--light-text-color)]">
                        <option value="price_asc" <?= $orderQuery === 'price_asc' ? 'selected' : '' ?>>Menor precio</option>
                        <option value="price_desc" <?= $orderQuery === 'price_desc' ? 'selected' : '' ?>>Mayor precio</option>
                        <option value="name_asc" <?= $orderQuery === 'name_asc' ? 'selected' : '' ?>>Nombre A-Z</option>
                        <option value="name_desc" <?= $orderQuery === 'name_desc' ? 'selected' : '' ?>>Nombre Z-A</option>
                    </select>
                </div>
            </form>
        </div>
        
        <div class="flex gap-4 flex-col w-full mt-4 lg:flex-row lg:justify-between">
            <!-- CATEGORIAS -->
            <aside class="w-full p-4 border-r-1 border-[var(--light-dark-color)] flex flex-col items-center text-center lg:max-w-[300px] lg:items-start lg:text-left">
                <span class="uppercase font-bold text-1xl">Categorías</span>
                <ul class="flex flex-col gap-2 mt-2">
                    <li><a href="index.php?page=products&cat=all" class='hover:text-[var(--primary-color)] text-[var(--dark-text-color)]'>Todos los productos</a></li>
                    <?php 
                        foreach ($categories as $category) {
                            echo("<li><a class='hover:text-[var(--primary-color)] text-[var(--dark-text-color)]' href='index.php?page=products&cat=" . $category->getId() . "'>" . $category->getName() . "</a></li>");
                        }
                    ?>
                </ul>
            </aside>
            
            <div class="flex flex-col w-full gap-8">
                <!-- PRODUCTOS -->
                <div class="w-full flex flex-wrap gap-4 pt-4">
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

                <!-- PAGINATION -->
                    <?php 
                        if($responseProducts["total_pages"] > 1) {
                            
                            $pageUrl = "index.php?page=products&cat=" . urlencode($categoryQuery) . "&order=" . urlencode($orderQuery) . "&search=" . urlencode($searchQuery);
                            
                            echo("<div class='flex justify-center items-center gap-4 my-4'>");
                                // prev
                                if ($pageQuery > 1) {
                                    echo "<a href='" . $pageUrl . "&sec=" . ($pageQuery - 1) . "' class='px-4 py-2 uppercase bg-[var(--primary-color)]'>Anterior</a>";
                                } else {
                                    echo "<span class='px-4 py-2 uppercase bg-[var(--primary-color)] opacity-50 cursor-not-allowed'>Anterior</span>";
                                }
                                
                                echo ("<div class='flex gap-2'>");
                                    // paginacion
                                    for ($i = 1; $i <= $responseProducts["total_pages"]; $i++) {
                                        if( $i !== $pageQuery) {
                                            echo ("<a href='" . $pageUrl . "&sec=" . $i . "' class='block px-4 py-2 border-1 border-[var(--light-dark-color)] hover:border-[var(--primary-color)]'>" . $i . "</a>");
                                        } else{
                                            echo ("<span class='block px-4 py-2 border-1 border-[var(--primary-color)] cursor-not-allowed'>" . $i . "</span>");
                                        }
                                        
                                    }
                                echo ("</div>");
                                
                                // next
                                if ($pageQuery < $responseProducts["total_pages"]) {
                                    echo "<a href='" . $pageUrl . "&sec=" . ($pageQuery + 1) . "' class='px-4 py-2 uppercase bg-[var(--primary-color)]'>Siguiente</a>";
                                } else {
                                    echo "<span class='px-4 py-2 uppercase bg-[var(--primary-color)] opacity-50 cursor-not-allowed'>Siguiente</span>";
                                }
                            echo("</div>");
                        }
                    ?>                
            </div>
    </div>
    </section>
</main>