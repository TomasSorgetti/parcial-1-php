<?php
require_once "lib/classes/Product.php";

$productId = $_GET["id"];

$product = Product::getProductById($productId);

?>

<main class="mt-8">
    <?php
    if ($product == null) {
        echo '<h1 class="mt-70 mb-70 text-3xl mt-32 font-bold uppercase text-center md:text-5xl">Producto no encontrado</h1>';
        return;
    }
    ?>
    <section class="flex flex-col justify-center items-center gap-8 max-w-[1280px] mx-auto my-32 px-4 lg:flex-row lg:px-0">
        <img src="assets/images/products/<?= $product->getImage() ?>" alt="<?= $product->getTitle() ?>" class="lg:p-8 lg:w-1/2" draggable="false" loading="lazy">
        <div class="flex flex-col gap-4 justify-center items-center text-center max-w-[700px] lg:text-left lg:w-1/2 lg:p-8 lg:items-start">
            <h1 class="uppercase font-bold text-3xl lg:text-5xl"><?= $product->getTitle() ?></h1>
            <div class="flex gap-2 flex-wrap">
                <?php
                foreach ($product->getTags() as $tag) {
                    echo ("<span class='text-[var(--primary-color)] text-2xl font-bold'>" . $tag->getName() . "</span>");
                }
                ?>
            </div>
            <p class="text-[var(--dark-text-color)]"><?= $product->getDescription() ?></p>
            <p>Marca: <?php echo Brand::getBrandById($product->getIdBrand())->getName() ?></p>
            <div class="w-full h-[1px] bg-[var(--primary-color)]"></div>
            <p class="text-[var(--dark-text-color)]">Precio especial <span class="font-bold text-[var(--primary-color)] text-3xl">$<?= $product->getOfferPrice() ?></span></p>
            <div class="w-4/5 h-[1px] bg-[var(--primary-color)]"></div>
            <p class="text-[var(--dark-text-color)]">12 cuotas fijas de <span class="font-bold text-2xl text-[var(--dark-text-color)]">$<?= $product->getQuotePrice() ?></span></p>
            <p class="text-[var(--dark-text-color)]">Precio de lista <span class="font-bold text-2xl text-[var(--dark-text-color)]">$<?= $product->getPrice() ?></span></p>

            <!-- Add to cart -->
            <form action="lib/actions/cart/addToCart.php" method="POST">
                <input type="hidden" name="productId" value="<?= $product->getId() ?>">
                <label for="quantity">Cantidad:</label>
                <input type="number" name="quantity" id="quantity" min="1" value="1" class=" border-2 border-gray-700 text-center w-24"></label>
                <input type="submit" value="Agregar al carrito" class="text-[var(--light-text-color)] px-6 py-3 bg-[var(--primary-color)] rounded-full text-center uppercase font-bold cursor-pointer">
            </form>
        </div>
    </section>
</main>