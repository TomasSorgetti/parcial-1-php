<?php
$brands = Brand::getAllBrands();
?>
<main>
    <section class="container mx-auto">
        <h1 class="text-3xl my-32 font-bold uppercase text-center md:text-5xl">Marcas</h1>
        <table class="w-full mt-20">
            <tbody class="w-full flex flex-col items-start gap-2">
                <?php foreach ($brands as $brand) : ?>
                    <tr class="w-full flex flex-col items-center justify-between bg-[#D9D9D913] p-4 rounded-sm md:flex-row">
                        <td class="flex-1">
                            <div id="display-<?= $brand->getId() ?>" class="brand-display">
                                <?= $brand->getName() ?>
                            </div>
                            <form id="update-form-<?= $brand->getId() ?>" action="actions/brands/update-brand.php" method="POST" class="hidden">
                                <input type="hidden" name="id" value="<?= $brand->getId() ?>">
                                <input type="text" name="name" value="<?= $brand->getName() ?>" required class="px-2 py-1 border border-gray-300 rounded-sm">
                                <button type="submit" class="bg-[var(--primary-color)] px-2 py-1 ml-2 rounded-sm text-white cursor-pointer">Guardar</button>
                                <button type="button" class="cancel-update bg-gray-400 px-2 py-1 ml-2 rounded-sm text-white cursor-pointer" data-id="<?= $brand->getId() ?>">Cancelar</button>
                            </form>
                        </td>
                        <td class="flex gap-8 mt-8 md:mt-0">
                            <button type="button" class="update-button bg-[var(--primary-color)] px-4 py-2 rounded-sm cursor-pointer" data-id="<?= $brand->getId() ?>">Editar</button>
                            <a href="actions/brands/delete-brand.php?id=<?= $brand->getId() ?>" role="button" class="bg-red-400 px-4 py-2 rounded-sm cursor-pointer">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="actions/brands/add-brand.php" method="POST" class="my-20 p-4 w-full flex justify-between flex-col gap-4 md:flex-row">
            <input type="text" name="name" placeholder="Nombre de Marca" required class="w-full md:w-1/3 px-4 py-3 rounded-sm border border-[#D9D9D913]">
            <button type="submit" class="bg-[var(--primary-color)] px-4 py-2 rounded-sm cursor-pointer">Agregar</button>
        </form>
    </section>
</main>
<script>
    document.querySelectorAll('.update-button').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            document.getElementById(`display-${id}`).classList.add('hidden');
            document.getElementById(`update-form-${id}`).classList.remove('hidden');
        });
    });

    document.querySelectorAll('.cancel-update').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            document.getElementById(`display-${id}`).classList.remove('hidden');
            document.getElementById(`update-form-${id}`).classList.add('hidden');
        });
    });
</script>