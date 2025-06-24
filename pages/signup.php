<main>
    <section class="min-h-[80vh] flex flex-col items-center gap-16 pt-50 pb-20 max-w-[1280px] mx-auto px-4">
        <h1 class="text-3xl font-bold uppercase text-center md:text-5xl">Registrarse</h1>
        <form action="lib/actions/auth/signup.php" method="POST" class=" flex flex-col gap-4 w-full max-w-[400px]">
            <?php
            if (isset($_SESSION['signupError'])) {
                echo '<p class="text-red-500 text-center">' . htmlspecialchars($_SESSION['signupError']) . '</p>';
                unset($_SESSION['signupError']);
            }
            ?>
            <div class="flex flex-col gap-2 w-full text-left">
                <label for="username">Nombre de usuario:</label>
                <input type="text" name="username" id="username" placeholder="Juan Perez" class="border-1 border-[var(--primary-color)] p-2 rounded-md" required>
            </div>
            <div class="flex flex-col gap-2 w-full text-left">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="abc@abc.com" class="border-1 border-[var(--primary-color)] p-2 rounded-md" required>
            </div>
            <div class="flex flex-col gap-2 w-full text-left">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="********" class="border-1 border-[var(--primary-color)] p-2 rounded-md" required>
            </div>
            <input type="submit" value="Registrarse" class="bg-[var(--primary-color)] text-white p-2 rounded-md mt-4 cursor-pointer">
            <p class="w-full text-center">Ya tienes una cuenta? <a href="index.php?page=signin" class="text-[var(--primary-color)] underline">Iniciar Sesión</a></p>
        </form>
    </section>
</main>