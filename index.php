<?php 
    $pageQuery = $_GET['page'] ?? 'home';

    $pageList = [
        [
            "page" => "home",
            "title" => "Bienvenido a Code Crafters",
            "description" => "Completar con saraza.",
        ],
        [
            "page" => "404",
            "title" => "Error 404",
            "description" => "Completar con saraza.",
        ],
        [
            "page" => "categories",
            "title" => "Categorias",
            "description" => "Completar con saraza.",
        ],
        [
            "page" => "category",
            "title" => "Categoría",
            "description" => "Completar con saraza.",
        ],
        [
            "page" => "productos",
            "title" => "Productos",
            "description" => "Completar con saraza.",
        ]
    ];http://localhost/davinci/ecommerce/index.php#

    if (!in_array($pageQuery, array_column($pageList, 'page'))) {
        $pageQuery = '404';
    };
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/global.css">
    <title>
        <?php echo $pageList[array_search($pageQuery, array_column($pageList, 'page'))]['title']; ?>
    </title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
      @theme {
        --background-color: #000000;
        --light-text-color: #ffffff;
        --dark-text-color: #C2C2C2;

        --light-dark-color: #171717;
        --primary-color: #8803FF;

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
    <header class="absolute top-0 left-0 w-full">
        <nav class="max-w-[1280px] mx-auto border-b-2 border-b-[var(--primary-color)] flex justify-between items-center py-6">
        <a href="index.php">Code Crafters</a>
        <ul class="flex gap-4">
            <li>Inicio</li>
            <li>Productos</li>
            <li>Comunidad</li>
            <li>Armá tu pc</li>
        </ul>
        </nav>
    </header>

    <?php 
        include_once 'src/pages/' . $pageQuery . '.php';
    ?>

    <footer>
        <p>&copy; 2023 RetroByte Shop. Todos los derechos reservados.</p>
    </footer>
</body>
</html>