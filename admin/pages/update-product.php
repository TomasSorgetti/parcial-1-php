<?php
$categories = Category::getAllCategories();
$brands = Brand::getAllBrands();
$tags = Tag::getAllTags();

$productId = $_GET["id"] ?? null;
$product = Product::getProductById($productId);

if (!$product) {
    die("Error: Producto no encontrado.");
}

echo "<pre class=''>";
print_r($product);
echo "</pre>";
?>
<main>
    <section class="container mx-auto text-center">
        <!-- Title -->
        <h1 class="text-3xl mt-32 font-bold uppercase text-center md:text-5xl"><?= htmlspecialchars($product->getTitle()) ?></h1>

        <!-- Form -->
        <form action="actions/products/update-product.php" method="POST" enctype="multipart/form-data" class="p-4 my-12 w-full max-w-[600px] mx-auto flex flex-col gap-4">
            <input type="hidden" name="id" value="<?= htmlspecialchars($product->getId()) ?>">

            <!-- Nombre del producto -->
            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="title">Nombre del producto:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($product->getTitle()) ?>" placeholder="Titulo" required class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <!-- Stock -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" value="<?= htmlspecialchars($product->getStock()) ?>" placeholder="0" required class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                </div>

                <!-- Precio -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="price">Precio:</label>
                    <input type="number" name="price" value="<?= htmlspecialchars($product->getPrice()) ?>" placeholder="0" required class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                </div>

                <!-- Precio de oferta -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="offer_price">Precio de oferta:</label>
                    <input type="number" name="offer_price" value="<?= htmlspecialchars($product->getOfferPrice() ?? '') ?>" placeholder="0" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                </div>
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <!-- Categoría -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="category">Categoría:</label>
                    <select name="category" id="category" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->getId() ?>" <?= $category->getId() == $product->getIdCategory() ? 'selected' : '' ?> class="text-white">
                                <?= htmlspecialchars($category->getName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Marca -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="brand">Marca:</label>
                    <select name="brand" id="brand" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->getId() ?>" <?= $brand->getId() == $product->getIdBrand() ? 'selected' : '' ?> class="text-white">
                                <?= htmlspecialchars($brand->getName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Imagen -->
            <div class="flex flex-col items-start text-left w-full">
                <label for="image">Imagen:</label>
                <input type="file" name="image" id="image" accept="image/*" class="cursor-pointer text-gray-500 my-4 px-4 py-3 rounded-sm border border-[#D9D9D913]">
                <input type="hidden" name="current_image" value="<?= htmlspecialchars($product->getImage()) ?>">
                <p id="imageName" class="text-gray-500"><?= $product->getImage() ? htmlspecialchars($product->getImage()) : 'Ningún archivo seleccionado' ?></p>
                <img id="imagePreview" src="<?= $product->getImage() ? '../assets/images/products/' . htmlspecialchars($product->getImage()) : '' ?>" alt="Vista previa de la imagen" class="mt-2 max-w-[200px] <?= $product->getImage() ? '' : 'hidden' ?>">
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
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción..." class="text-[var(--dark-text-color)] w-full h-[200px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)] resize-none"><?= htmlspecialchars($product->getDescription() ?? '') ?></textarea>
            </div>

            <!-- Boton -->
            <input type="submit" value="Actualizar producto" class="bg-[var(--primary-color)] text-white p-2 rounded-md mt-4 cursor-pointer">
        </form>
    </section>
</main>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const imageName = document.getElementById('imageName');
        const file = e.target.files[0];

        if (file) {
            imageName.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            const currentImage = '<?= $product->getImage() ? htmlspecialchars($product->getImage()) : "Ningún archivo seleccionado" ?>';
            imageName.textContent = currentImage;
            preview.src = '<?= $product->getImage() ? "../assets/images/products/" . htmlspecialchars($product->getImage()) : "" ?>';
            preview.classList.toggle('hidden', !preview.src);
        }
    });
</script>