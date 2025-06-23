<?php
$categories = Category::getAllCategories();
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
                <?php foreach ($categories as $category) : ?>
                    <tr class="w-full flex items-center justify-between bg-[#D9D9D923] p-2 rounded-sm">
                        <td><?= $category->getName() ?></td>
                        <td class="flex gap-8 ">
                            <a href="" role="button" class="bg-green-400 px-4 py-2">Editar</a>
                            <a href="actions/categories/delete-category.php?id=<?= $category->getId() ?>" role="button" class="bg-red-400 px-4 py-2">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="actions/categories/add-category.php" method="POST" class="mt-20 w-full flex justify-between">
            <input type="text" name="name" placeholder="Nombre de categoría" required>
            <input type="text" name="path" placeholder="Path de categoría" required>
            <button type="submit">Agregar</button>
        </form>
    </section>
</main>