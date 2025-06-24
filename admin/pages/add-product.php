<?php
$products = Product::getProductsWithoutPagination();
$categories = Category::getAllCategories();
$brands = Brand::getAllBrands();
$tags = Tag::getAllTags();

?>

<main>
    <section class="container mx-auto text-center">
        <h1 class="text-3xl mt-32 font-bold uppercase text-center md:text-5xl">Añadir producto</h1>
        <form action="actions/products/add-product.php" method="POST" enctype="multipart/form-data" class="p-4 my-12 w-full max-w-[600px] mx-auto flex flex-col gap-4">
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
                    <label for="brand">Marca:</label>
                    <select name="brand" id="brand" class="w-full">
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->getId() ?>"><?= $brand->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex flex-col items-start text-left w-full">
                <label for="image">Imagen:</label>
                <input type="file" name="image" id="image" accept="image/*" required class="cursor-pointer">
            </div>

            <!-- Tags -->
            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="tags">Etiquetas:</label>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($tags as $tag) : ?>
                        <input type="checkbox" name="tags[]" id="tag-<?= $tag->getId() ?>" value="<?= $tag->getId() ?>">
                        <label for="tag-<?= $tag->getId() ?>"><?= $tag->getName() ?></label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="description">Descripcion:</label>
                <textarea name="description" id="description" cols="30" rows="10" required placeholder="Descripción..." class="w-full"></textarea>
            </div>

            <input type="submit" value="Añadir producto" class="bg-[var(--primary-color)] text-white p-2 rounded-md mt-4 cursor-pointer">
        </form>
    </section>
</main>