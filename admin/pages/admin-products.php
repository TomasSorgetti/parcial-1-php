<?php
$products = Product::getProductsWithoutPagination();

?>
<main>
    <section class="container mx-auto">
        <h1 class="mt-32">Productos</h1>
        <div class="mt-12 flex justify-between items-center">
            <input type="text" name="search" value="search" placeholder="not implemented">
            <a href="index.php?page=add-product">Agregar Producto</a>
        </div>
        <table class="w-full mt-20">
            <tbody class="w-full flex flex-col items-start gap-4">
                <?php foreach ($products as $product) : ?>
                    <tr class="w-full flex items-center justify-between bg-[#D9D9D923] p-2 rounded-sm">
                        <td><?= $product->getTitle() ?></td>
                        <td class="flex gap-8 ">
                            <a href="" role="button" class="bg-green-400 px-4 py-2">Editar</a>
                            <a href="actions/products/delete-product.php?id=<?= $product->getId() ?>" role="button" class="bg-red-400 px-4 py-2">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>