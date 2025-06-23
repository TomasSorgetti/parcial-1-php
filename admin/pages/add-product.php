<?php
$products = Product::getProductsWithoutPagination();
$categories = Category::getAllCategories();
$brands = Brand::getAllBrands();

?>
<main>
    <section class="container mx-auto text-center">
        <h1 class="mt-32">Añadir producto</h1>
        <form action="actions/products/add-product.php" method="POST" class="p-4 my-12 w-full max-w-[600px] mx-auto flex flex-col gap-4">
            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="title">Nombre del producto:</label>
                <input type="text" name="title" placeholder="Titulo" required class="w-full">
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" placeholder="0" required class="w-full">
                </div>

                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="price">Precio:</label>
                    <input type="number" name="price" placeholder="0" required class="w-full">
                </div>

                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="offer_price">Precio de oferta:</label>
                    <input type="number" name="offer_price" placeholder="0" class="w-full">
                </div>
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="category">Categoría:</label>
                    <select name="category" id="category" class="w-full">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="category">Marca:</label>
                    <select name="category" id="category" class="w-full">
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->getId() ?>"><?= $brand->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex flex-col items-start text-left w-full">
                <label for="image">Imagen:</label>
                <input type="file" name="image" id="image" required class="cursor-pointer">
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="description">Descripcion:</label>
                <textarea name="description" id="description" cols="30" rows="10" required placeholder="Descripción..." class="w-full"></textarea>
            </div>
        </form>
    </section>
</main>