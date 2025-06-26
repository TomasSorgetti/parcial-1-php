<?php
$categories = Category::getAllCategories();
?>
<main>
    <section class="container mx-auto">
        <h1 class="text-3xl my-32 font-bold uppercase text-center md:text-5xl">Categorías</h1>
        <table class="w-full mt-20">
            <tbody class="w-full flex flex-col items-start gap-2">
                <?php foreach ($categories as $category) : ?>
                    <tr class="w-full flex flex-col items-center justify-between bg-[#D9D9D913] p-4 rounded-sm md:flex-row">
                        <td class="flex-1">
                            <div id="display-<?= $category->getId() ?>" class="category-display">
                                <?= $category->getName() ?>
                            </div>
                            <form id="update-category-<?= $category->getId() ?>" action="actions/categories/update-category.php" method="POST" class="hidden">
                                <input type="hidden" name="id" value="<?= $category->getId() ?>">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" value="<?= $category->getName() ?>" required class="px-2 py-1 border border-gray-300 rounded-sm">
                                <label for="path">Path:</label>
                                <input type="text" name="path" value="<?= $category->getPath() ?>" required class="px-2 py-1 border border-gray-300 rounded-sm">
                                <button type="submit" class="bg-[var(--primary-color)] px-2 py-1 ml-2 rounded-sm text-white cursor-pointer">Guardar</button>
                                <button type="button" class="cancel-edit bg-gray-400 px-2 py-1 ml-2 rounded-sm text-white cursor-pointer" data-id="<?= $category->getId() ?>">Cancelar</button>
                            </form>
                        </td>
                        <td class="flex gap-8 mt-8 md:mt-0">
                            <button type="button" class="update-button bg-[var(--primary-color)] px-4 py-2 rounded-sm cursor-pointer" data-id="<?= $category->getId() ?>">Editar</button>
                            <a href="actions/categories/delete-category.php?id=<?= $category->getId() ?>" role="button" class="bg-red-400 px-4 py-2 rounded-sm cursor-pointer">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="actions/categories/add-category.php" method="POST" class="my-20 p-2 w-full flex justify-between flex-col gap-8 md:flex-row">
            <div class="w-full flex flex-col items-center gap-4 md:flex-row">
                <input type="text" name="name" placeholder="Nombre de categoría" required class="w-full md:w-1/3 px-4 py-3 rounded-sm border border-[#D9D9D913]">
                <input type="text" name="path" placeholder="Path de categoría" required class="w-full md:w-1/3 px-4 py-3 rounded-sm border border-[#D9D9D913]">
            </div>
            <button type="submit" class="bg-[var(--primary-color)] px-8 py-2 cursor-pointer rounded-sm">Agregar</button>
        </form>
    </section>
</main>

<script>
    document.querySelectorAll('.update-button').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            document.getElementById(`display-${id}`).classList.add('hidden');
            document.getElementById(`update-category-${id}`).classList.remove('hidden');
        });
    });

    document.querySelectorAll('.cancel-edit').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            document.getElementById(`display-${id}`).classList.remove('hidden');
            document.getElementById(`update-category-${id}`).classList.add('hidden');
        });
    });
</script>