<?php
$products = Product::getProductsWithoutPagination();

?>
<main>
    <section class="container mx-auto">
        <h1 class="text-3xl my-42 font-bold uppercase text-center md:text-5xl">Productos</h1>
        <div class="mt-12 flex justify-between items-center">
            <input type="text" name="search" placeholder="not implemented" class="w-1/3 px-4 py-3 rounded-sm border border-[#D9D9D913]">
            <a href="index.php?page=add-product" class="bg-[var(--primary-color)] px-6 py-3 rounded-sm">Agregar Producto</a>
        </div>
        <table class="w-full my-20">
            <tbody class="w-full flex flex-col items-start gap-2">
                <?php foreach ($products as $product) : ?>
                    <tr class="w-full flex items-center justify-between bg-[#D9D9D913] p-4 rounded-sm">
                        <td class="font-bold uppercase"><?= $product->getTitle() ?></td>
                        <td class="flex gap-8 ">
                            <a href="index.php?page=update-product&id=<?= $product->getId() ?>" role="button" class="bg-[var(--primary-color)] px-4 py-2 rounded-sm">Editar</a>
                            <a href="actions/products/delete-product.php?id=<?= $product->getId() ?>" role="button" class="bg-red-400 px-4 py-2 rounded-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>