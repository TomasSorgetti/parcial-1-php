<?php
$isLoggedIn = $_SESSION['session'];

if (empty($isLoggedIn)) {
    header("Location: index.php?page=signin");
}

$cartItems = Cart::get();
?>

<main class="container mx-auto">
    <section class="max-w-[900px] mx-auto flex flex-col gap-12 mb-20">
        <h1 class="mt-40 text-3xl font-bold uppercase text-center md:text-5xl">Finalizar compra</h1>
        <div>
            <?php
            if (empty($cartItems)) {
                echo (
                    "<span class='mt-8'>El carrito esta vacío.</span>"
                );
            } else {
                foreach ($cartItems as $productId => $product) {
                    echo (
                        "<div class='p-2 flex items-center justify-between w-full h-32 border-b-2 border-b-[var(--light-dark-color)] gap-2'>
                    <div class='w-12 h-16 overflow-hidden'>
                    <img src='assets/images/products/$product[image]' alt='$product[title]' draggable='false' loading='lazy' class='w-full h-full object-cover'>
                    </div>
                    <div class='max-w-[100px] w-full overflow-hidden'>
                    <p class='block w-full'>$product[title]</p>
                    </div>
                    <div>
                    <div>
                        <a href='lib/actions/cart/updateCart.php?productId=$productId&add=false&quantity=$product[quantity]&page=checkout' class='cursor-pointer font-bold text-lg bg-[var(--primary-color)] hover:bg-[var(--alter-color)] px-2 h-full'>-</a>

                        <input type='number' name='quantity' value='$product[quantity]' min='1' max='10' readonly class='w-20 border-2 border-gray-700 text-center'/>

                        <a href='lib/actions/cart/updateCart.php?productId=$productId&add=true&quantity=$product[quantity]&page=checkout' class='cursor-pointer font-bold text-lg bg-[var(--primary-color)] hover:bg-[var(--alter-color)] px-2 h-full'>+</a>
                    </div>
                    <p class='font-bold text-lg '>$ $product[price]</p>
                    </div>
                    <a href='lib/actions/cart/deleteFromCart.php?productId=$productId&page=checkout' class='cursor-pointer font-bold text-lg hover:text-[var(--primary-color)]'>X</a>
                    </div>"
                    );
                }
            }
            ?>
        </div>
        <p class="font-bold text-3xl">Total: $<?php echo Cart::getTotal(); ?></p>
        <a href="lib/actions/cart/purchase.php" class="cursor-pointer w-full text-center bg-[var(--primary-color)] py-2 rounded-sm">Finalizar compra</a>
    </section>
</main>