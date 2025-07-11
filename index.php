<?php
require_once 'lib/utils/autoload.php';

$pageQuery = $_GET['page'] ?? 'home';

$page = Page::getPage($pageQuery);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <title>
        <?php echo ($page->getTitle()); ?>
    </title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        :root {
      --background-color: #000000;
      --light-text-color: #ffffff;
      --dark-text-color:#dadada;
      
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
    <header id="header" class="fixed top-0 left-0 w-full z-30 bg-[var(--transparent-black-color)]">
        <?php
        $isAdmin = User::isAdmin();

        if ($isAdmin) {
            echo (
                "<div class='bg-[var(--primary-color)]'>
                    <div class='container mx-auto flex w-full justify-end'>
                        <a href='admin/index.php' class='text-white font-bold py-1 cursor-pointer'>Dashboard</a>
                    </div>
                </div>"
            );
        }
        ?>
        <nav class="max-w-[1280px] mx-auto px-4 border-b-2 border-b-[var(--primary-color)] transition-all duration-500 ease-in-out lg:px-0">
            <div class="flex justify-between items-center py-6 max-w-[1280px] mx-auto">
                <!-- Logo -->
                <a href="index.php?page=home" class="uppercase font-bold text-xl text-[var(--light-text-color)] z-60">Code Crafters</a>
                <!-- Hamburger -->
                <button id="hamburger" class="z-60 flex flex-col items-center justify-center gap-2 lg:hidden">
                    <div class="bar w-8 h-1 bg-[var(--light-text-color)]"></div>
                    <div class="bar w-8 h-1 bg-[var(--light-text-color)]"></div>
                    <div class="bar w-8 h-1 bg-[var(--light-text-color)]"></div>
                </button>

                <!-- Menu -->
                <ul id="menu" class="fixed top-0 right-0 w-full h-screen bg-[var(--background-color)] flex flex-col items-center justify-center gap-12 z-40 lg:static lg:w-auto lg:h-auto lg:flex-row lg:bg-transparent">
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=home">Inicio</a>
                    </li>
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=products">Productos</a>
                    </li>
                    <li>
                        <a class="uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]" href="index.php?page=data">Datos</a>
                    </li>
                    <li>
                        <?php
                        $isLoggedIn = empty($_SESSION['session']);

                        if (!$isLoggedIn) {
                            echo ("<a class='uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]' href='lib/actions/auth/logout.php'>Logout</a>");
                        } else {
                            echo ("<a class='uppercase hover:text-[var(--primary-color)] text-[var(--dark-text-color)]' href='index.php?page=signin'>Login</a>");
                        }
                        ?>
                    </li>
                    <li>
                        <a class="uppercase text-[var(--light-text-color)] px-6 py-3 bg-[var(--primary-color)] transition-all duration-500 ease-in-out hover:bg-[var(--alter-color)] hover:border-[var(--alter-color)] rounded-full" href="index.php?page=build">Armá tu pc</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <?php
    include_once 'pages/' . $page->getPath() . '.php';
    ?>


    <!-- Cart -->
    <div id="cart" class="fixed bottom-4 right-4 flex items-end gap-4 h-full max-h-[540px] transition-all duration-500 ease-in-out">
        <button id="cart-button" class="z-10 bg-black cursor-pointer w-20 h-20 border-2 border-gray-700 rounded-full p-2 hover:border-[var(--primary-color)] flex items-center justify-center">
            <img src="./assets/icons/cart.svg" alt="cart icon">
        </button>

        <div class="w-100 h-full bg-[var(--background-color)] border-2 border-gray-700 rounded-lg p-4 flex flex-col justify-between items-start gap-4">
            <span class="text-2xl font-bold">Carrito de compras</span>
            <!-- Products -->
            <div class="h-full overflow-y-scroll w-full flex flex-col items-start gap-2">
                <?php
                $cart = Cart::get();

                if (empty($cart)) {
                    echo (
                        "<span class='mt-8'>El carrito esta vacío.</span>                        "
                    );
                } else {
                    foreach ($cart as $productId => $product) {
                        echo (
                            "<div class='p-2 flex items-center justify-between w-full h-32 border-b-2 border-b-[var(--light-dark-color)] gap-2'>
                            <div class='w-12 h-16 overflow-hidden'>
                                <img src='assets/images/products/$product[image]' alt='$product[title]' draggable='false' loading='lazy' class='w-full h-full object-cover'>
                            </div>
                            <div>
                                <p class='block w-full'>$product[title]</p>
                                <div class='flex justify-start gap-2'>
                                    <p class='font-bold text-lg '>$ $product[price]</p>
                                    <div>
                                        <a href='lib/actions/cart/updateCart.php?productId=$productId&add=false&quantity=$product[quantity]' class='cursor-pointer font-bold text-lg bg-[var(--primary-color)] hover:bg-[var(--alter-color)] px-2 h-full'>-</a>

                                        <input type='number' name='quantity' value='$product[quantity]' min='1' max='10' readonly class='w-20 border-2 border-gray-700 text-center'/>

                                        <a href='lib/actions/cart/updateCart.php?productId=$productId&add=true&quantity=$product[quantity]' class='cursor-pointer font-bold text-lg bg-[var(--primary-color)] hover:bg-[var(--alter-color)] px-2 h-full'>+</a>
                                    </div>
                                </div>
                            </div>
                            <a href='lib/actions/cart/deleteFromCart.php?productId=$productId' class='cursor-pointer font-bold text-lg hover:text-[var(--primary-color)]'>X</a>
                            </div>"
                        );
                    }
                }
                ?>
            </div>

            <p>Total: $<?php echo Cart::getTotal(); ?></p>
            <a href="lib/actions/cart/emptyCart.php" class="cursor-pointer w-full text-center rounded-sm border-2 border-gray-700 py-2">Vaciar carrito</a>
            <a href="index.php?page=checkout" class="cursor-pointer w-full text-center bg-[var(--primary-color)] py-2 rounded-sm">Comprar</a>
        </div>
    </div>


    <footer class="h-60 text-center flex justify-center items-center border-t-1 border-t-[var(--light-dark-color)]">
        <?php echo ("<p>&copy; " . date('Y') . " Tomás Sorgetti. Todos los derechos reservados.</p>"); ?>
    </footer>

    <script src="lib/scripts/navbar.js"></script>
    <script src="lib/scripts/cart.js"></script>
    <script src="lib/scripts/products.js"></script>
    <script src="lib/scripts/buildForm.js"></script>
</body>

</html>