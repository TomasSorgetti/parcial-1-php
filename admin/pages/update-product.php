<?php
$categories = Category::getAllCategories();
$brands = Brand::getAllBrands();
$tags = Tag::getAllTags();

$productId = $_GET["id"] ?? null;
$product = Product::getProductById($productId);

//? deberia hacer un die, mandar a 404 o mostrar mensaje???
if (!$product) {
    die("Error: Producto no encontrado.");
}

?>
<main>
    <section class="container mx-auto text-center">
        <!-- Title -->
        <h1 class="text-3xl mt-32 font-bold uppercase text-center md:text-5xl"><?= $product->getTitle() ?></h1>

        <!-- Form -->
        <form action="actions/products/update-product.php" method="POST" enctype="multipart/form-data" class="p-4 my-12 w-full max-w-[600px] mx-auto flex flex-col gap-4">

            <input type="hidden" name="id" value="<?= htmlspecialchars($product->getId()) ?>">

            <!-- Nombre del producto -->
            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="title">Nombre del producto:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($product->getTitle()) ?>" placeholder="Titulo" required class="w-full px-4 py-3 rounded-sm border border-[#D9D9D913] text-gray-500">
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <!-- Stock -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" value="<?= htmlspecialchars($product->getStock()) ?>" placeholder="0" required class="w-full px-4 py-3 rounded-sm border border-[#D9D9D913] text-gray-500">
                </div>

                <!-- Precio -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="price">Precio:</label>
                    <input type="number" name="price" value="<?= htmlspecialchars($product->getPrice()) ?>" placeholder="0" required class="w-full px-4 py-3 rounded-sm border border-[#D9D9D913] text-gray-500">
                </div>

                <!-- Precio de oferta -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="offer_price">Precio de oferta:</label>
                    <input type="number" name="offer_price" value="<?= htmlspecialchars($product->getOfferPrice() ?? '') ?>" placeholder="0" class="w-full px-4 py-3 rounded-sm border border-[#D9D9D913] text-gray-500">
                </div>
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <!-- Categoría -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="category">Categoría:</label>
                    <select name="category" id="category" class="w-full px-4 py-3 rounded-sm border border-[#D9D9D913]">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->getId() ?>" <?= $category->getId() == $product->getIdCategory() ? 'selected' : '' ?> class="text-black">
                                <?= htmlspecialchars($category->getName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Marca -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="brand">Marca:</label>
                    <select name="brand" id="brand" class="w-full px-4 py-3 rounded-sm border border-[#D9D9D913]">
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->getId() ?>" <?= $brand->getId() == $product->getIdBrand() ? 'selected' : '' ?> class="text-black">
                                <?= htmlspecialchars($brand->getName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Imagen -->
            <div class="flex flex-col items-start text-left w-full">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" accept="image/*" class="cursor-pointer text-gray-500">
                <p class="text-gray-500">Imagen actual: <?= htmlspecialchars($product->getImage()) ?></p>
            </div>

            <!-- Tags -->
            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="tags">Etiquetas:</label>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($tags as $tag) : ?>
                        <input
                            type="checkbox"
                            name="tags[]"
                            id="tag-<?= $tag->getId() ?>"
                            value="<?= $tag->getId() ?>"
                            <?= array_key_exists($tag->getId(), $product->getTags()) ? 'checked' : '' ?>>
                        <label class="text-gray-500" for="tag-<?= $tag->getId() ?>"><?= $tag->getName() ?></label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Descripción -->
            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción..." class="w-full px-4 py-3 rounded-sm border border-[#D9D9D913] text-gray-500"><?= htmlspecialchars($product->getDescription() ?? '') ?></textarea>
            </div>

            <!-- Boton -->
            <input type="submit" value="Actualizar producto" class="bg-[var(--primary-color)] text-white p-2 rounded-md mt-4 cursor-pointer">
        </form>
    </section>
</main>