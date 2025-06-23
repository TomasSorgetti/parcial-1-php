<?php
$brands = Brand::getAllBrands();
?>
<main>
    <section class="container mx-auto">
        <h1>Categorías</h1>
        <div>
            <input type="text" name="search" value="search" placeholder="not implemented">
            <a href="index.php?page=add-category"></a>
        </div>
        <table class="w-full mt-20">
            <tbody class="w-full flex flex-col items-start gap-4">
                <?php foreach ($brands as $brand) : ?>
                    <tr class="w-full flex items-center justify-between bg-[#D9D9D923] p-2 rounded-sm">
                        <td><?= $brand->getName() ?></td>
                        <td class="flex gap-8 ">
                            <a href="" role="button" class="bg-green-400 px-4 py-2">Editar</a>
                            <a href="actions/brands/delete-brand.php?id=<?= $brand->getId() ?>" role="button" class="bg-red-400 px-4 py-2">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="actions/brands/add-brand.php" method="POST" class="my-20 w-full flex justify-between">
            <input type="text" name="name" placeholder="Nombre de Marca" required>
            <button type="submit">Agregar</button>
        </form>
    </section>
</main>