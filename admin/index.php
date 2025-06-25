<?php
require_once '../lib/utils/autoload.php';

$pageQuery = $_GET['page'] ?? 'dashboard';

$page = Page::getPage($pageQuery);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">

    <title>
        <?php echo ($page->getTitle()); ?>
    </title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        :root {
      --background-color: #000000;
      --light-text-color: #ffffff;
      --dark-text-color: #C2C2C2;
      
      --light-dark-color: #171717;
      --primary-color:rgb(116, 12, 207);
      --alter-color:#8803FF;
      --transparent-black-color:rgba(0, 0, 0, 0.76);

      --font-size-base: 16px;
      --font-size-lg: 18px;
      --font-size-xl: 24px;
      --font-size-2xl: 32px;
      --font-size-3xl: 38px;
      --font-size-4xl: 52px;
      --font-size-5xl: 56px;
    }
    </style>
</head>

<body class="bg-[var(--background-color)] text-[var(--light-text-color)]">

    <div class="fixed top-20 right-20 z-50 flex flex-col space-y-2 w-80">
        <?php echo Alert::get(); ?>
    </div>

    <header id="header" class="fixed top-0 left-0 w-full z-30 bg-[var(--transparent-black-color)]">
        <nav class="max-w-[1280px] mx-auto px-4 border-b-2 border-b-[var(--primary-color)] transition-all duration-500 ease-in-out lg:px-0">
            <div class="flex justify-between items-center py-6 max-w-[1280px] mx-auto">
                <!-- Logo -->
                <a href="../index.php?page=home" class="uppercase font-bold text-xl text-[var(--light-text-color)] z-60">Code Crafters</a>
                <!-- Hamburger -->
                <button id="hamburger" class="z-60 flex flex-col items-center justify-center gap-2 lg:hidden">
                    <div class="bar w-8 h-1 bg-[var(--light-text-color)]"></div>
                    <div class="bar w-8 h-1 bg-[var(--light-text-color)]"></div>
                    <div class="bar w-8 h-1 bg-[var(--light-text-color)]"></div>
                </button>

                <!-- Menu -->
                <ul id="menu" class="fixed top-0 right-0 w-full h-screen bg-[var(--background-color)] flex flex-col items-center justify-center gap-12 z-40 lg:static lg:w-auto lg:h-auto lg:flex-row lg:bg-transparent">
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=admin-products">Productos</a>
                    </li>
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=admin-categories">Categorías</a>
                    </li>
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=admin-brands">Marcas</a>
                    </li>
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=admin-tags">Etiquetas</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <?php
    include_once 'pages/' . $page->getPath() . '.php';
    ?>

    <footer class="h-60 text-center flex justify-center items-center border-t-1 border-t-[var(--light-dark-color)]">
        <?php echo ("<p>&copy; " . date('Y') . " Tomás Sorgetti. Todos los derechos reservados.</p>"); ?>
    </footer>

    <script src="../lib/scripts/navbar.js"></script>
</body>

</html>