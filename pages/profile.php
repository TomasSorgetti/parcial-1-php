<?php
$user = User::getUser($_SESSION['session']['email'], $_SESSION['session']['username']);
$purchases = Purchase::getByUserId($user->getId());

?>

<main class="mt-8 container mx-auto">
    <h1 class="mt-32 text-3xl font-bold uppercase text-center md:text-5xl">Perfil de usuario</h1>
    <p>Nombre de usuario: <?= $user->getUsername() ?></p>
    <p>Email: <?= $user->getEmail() ?></p>
    <p>Rol: <?= $user->getRole() ?></p>

    <div class="my-12 flex flex-col gap-4 text-left">
        <h2 class="mt-8 text-2xl font-bold uppercase md:text-3xl">Historial de compras</h2>
        <?php
        if (empty($purchases)) {
            echo "<p class='my-12'>No hay compras realizadas.</p>";
        } else {
            foreach ($purchases as $purchase) {
                echo "
                <div class='border-1 border-[var(--light-dark-color)] flex flex-col items-start justify-between py-6 px-4 rounded-md gap-4 bg-[#101010]'>
                <h3 class='font-bold md:text-2xl'>" . $purchase['detail'] . "</h3>
                <p>Fecha: " . $purchase['date'] . "</p>
                <p>Monto: $" . $purchase['amount'] . "</p>
                </div>
                ";
            };
        }
        ?>
    </div>
</main>