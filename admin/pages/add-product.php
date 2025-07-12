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
                <input type="text" name="title" placeholder="Titulo" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" placeholder="0" required class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                </div>

                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="price">Precio:</label>
                    <input type="number" name="price" placeholder="0" required class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                </div>

                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="offer_price">Precio de oferta:</label>
                    <input type="number" name="offer_price" placeholder="0" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                </div>
            </div>


            <div class="flex flex-col gap-2 items-start text-left w-full md:flex-row md:gap-4">
                <!-- Categoría -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="category">Categoría:</label>
                    <select name="category" id="category" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->getId() ?>" class="text-white"><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Marca -->
                <div class="flex flex-col gap-2 items-start text-left w-full">
                    <label for="brand">Marca:</label>
                    <select name="brand" id="brand" class="text-[var(--dark-text-color)] w-full h-[48px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)]">
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->getId() ?>" class="text-white"><?= $brand->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Image -->
            <div class="flex flex-col items-start text-left w-full">
                <label for="image">Imagen:</label>
                <input type="file" name="image" id="image" accept="image/*" required class="cursor-pointer text-gray-500 my-4 px-4 py-3 rounded-sm border border-[#D9D9D913]">
                <img id="imagePreview" class="mt-4 max-w-[200px] hidden" alt="Vista previa de la imagen">
            </div>

            <!-- Tags -->
            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="tags">Etiquetas:</label>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($tags as $tag) : ?>
                        <input type="checkbox" name="tags[]" id="tag-<?= $tag->getId() ?>" value="<?= $tag->getId() ?>" class="cursor-pointer">
                        <label for="tag-<?= $tag->getId() ?>"><?= $tag->getName() ?></label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="flex flex-col gap-2 items-start text-left w-full">
                <label for="description">Descripcion:</label>
                <textarea name="description" id="description" cols="30" rows="10" required placeholder="Descripción..." class="text-[var(--dark-text-color)] w-full h-[200px] border-b-1 border-[var(--primary-color)] bg-[var(--background-color)] resize-none"></textarea>
            </div>

            <input type="submit" value="Añadir producto" class="bg-[var(--primary-color)] text-white p-2 rounded-md mt-4 cursor-pointer">
        </form>
    </section>
</main>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    });
</script>