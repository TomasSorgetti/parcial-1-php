<?php
$isAdmin = $_SESSION['session']['role'] == 'admin' || $_SESSION['session']['role'] == 'superadmin';
$isSuperAdmin = $_SESSION['session']['role'] == 'superadmin';

$users = User::getAllUsers();
?>
<main>
    <!-- Title -->
    <h1 class="text-3xl mt-32 font-bold uppercase text-center md:text-5xl">Dashboard</h1>

    <section class="container mx-auto p-4 my-20">
        <!-- Users title -->
        <h2 class="text-2xl mt-32 font-bold uppercase md:text-3xl">Usuarios</h2>

        <!-- User table -->
        <table class="w-full mt-12">
            <tbody class="w-full flex flex-col items-start gap-2">
                <?php foreach ($users as $user) : ?>
                    <tr class="w-full flex flex-col items-center justify-between  bg-[#D9D9D913] p-4 rounded-sm md:flex-row md:flex-wrap">
                        <!-- User Name -->
                        <td class="font-bold uppercase md:min-w-[120px]"><?= $user->getUsername() ?></td>
                        <!-- User Email -->
                        <td class="font-bold"><?= $user->getEmail() ?></td>
                        <!-- User Role -->
                        <td class="font-bold "><?= $user->getRole() ?></td>
                        <!-- User Actions -->
                        <?php if ($isAdmin && $user->getRole() != 'superadmin') : ?>
                            <td class="flex gap-8 mt-4 md:mt-0">
                                <a href="" role="button" class="bg-[var(--primary-color)] px-4 py-2 rounded-sm cursor-not-allowed">Editar</a>
                                <a href="" role="button" class="bg-red-400 px-4 py-2 rounded-sm cursor-not-allowed">Eliminar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>