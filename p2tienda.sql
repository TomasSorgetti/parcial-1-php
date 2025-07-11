-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-06-2025 a las 19:49:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `p2tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'AMD'),
(6, 'ASUS'),
(5, 'Corsair'),
(7, 'Gigabyte'),
(2, 'Intel'),
(8, 'Kingston'),
(4, 'MSI'),
(3, 'NVIDIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `path`) VALUES
(1, 'Motherboards', 'motherboards'),
(2, 'Procesadores', 'procesadores'),
(3, 'Memorias RAM', 'memorias-ram'),
(4, 'Tarjetas Gráficas', 'tarjetas-graficas'),
(5, 'Almacenamiento', 'almacenamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `page`
--

CREATE TABLE `page` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `restricted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `page`
--

INSERT INTO `page` (`id`, `path`, `title`, `active`, `restricted`) VALUES
(1, 'home', 'Bienvenido', 1, 0),
(2, 'products', 'Productos', 1, 0),
(3, 'product', 'productoP', 1, 0),
(4, 'build', 'Armá tu pc', 1, 0),
(5, 'data', 'Datos del Alumno', 1, 0),
(6, 'success', 'Se enviaron los datos', 1, 0),
(7, 'signin', 'Iniciar sesión', 1, 0),
(8, 'signup', 'Registrarse', 1, 0),
(9, 'dashboard', 'Dashboard', 1, 1),
(10, 'admin-categories', 'Categorías', 1, 1),
(11, 'admin-brands', 'Marcas', 1, 1),
(12, 'admin-tags', 'Etiquetas', 1, 1),
(13, 'admin-products', 'Productos', 1, 1),
(14, 'add-product', 'Añadir producto', 1, 1),
(15, 'update-product', 'Modificar producto', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_category` int(10) UNSIGNED NOT NULL,
  `id_brand` int(10) UNSIGNED NOT NULL,
  `title` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `offer_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `id_category`, `id_brand`, `title`, `image`, `description`, `stock`, `price`, `offer_price`) VALUES
(1, 2, 1, 'Procesador AMD Ryzen 3 3200G 4.0GHz', '1750865256.png', 'Procesador AMD Ryzen 3 3200G con 4 núcleos y 4 hilos, ideal para tareas diarias y gaming ligero. Incluye gráficos integrados Radeon Vega 8, perfecto para sistemas compactos sin GPU dedicada. Velocidad máxima de 4.0 GHz y arquitectura Zen+ para un rendimiento eficiente.', 20, 700.00, 700.00),
(2, 2, 1, 'Procesador AMD Ryzen 5 5500 4.2GHz', '1750865394.png', 'El AMD Ryzen 5 5500 ofrece 6 núcleos y 12 hilos, optimizado para gaming y multitarea. Con una frecuencia boost de 4.2 GHz y arquitectura Zen 3, asegura un rendimiento sólido para aplicaciones exigentes y juegos modernos a un precio accesible.', 20, 700.00, 700.00),
(3, 2, 1, 'Procesador AMD Ryzen 7 5700X 4.6GHz', '1750865422.png', 'Potente AMD Ryzen 7 5700X con 8 núcleos y 16 hilos, diseñado para creadores de contenido y gamers. Alcanza hasta 4.6 GHz con arquitectura Zen 3, ofreciendo un rendimiento excepcional en edición de video, streaming y juegos AAA. Compatible con PCIe 4.0.', 20, 700.00, 700.00),
(4, 2, 1, 'Procesador AMD Ryzen 7 7700 5.3GHz', '1750865438.png', 'El AMD Ryzen 7 7700 cuenta con 8 núcleos y 16 hilos, ideal para cargas de trabajo intensivas y gaming de alto nivel. Con arquitectura Zen 4 y un boost de 5.3 GHz, ofrece eficiencia energética y soporte para DDR5 y PCIe 5.0, perfecto para sistemas modernos.', 20, 700.00, 700.00),
(5, 2, 1, 'Procesador AMD Ryzen 9 7900 5.4GHz', '1750865454.png', 'Procesador de élite AMD Ryzen 9 7900 con 12 núcleos y 24 hilos, diseñado para profesionales y entusiastas. Con arquitectura Zen 4 y hasta 5.4 GHz, destaca en renderizado 3D, edición de video y gaming extremo. Soporta DDR5 y PCIe 5.0 para máxima conectividad.', 20, 700.00, 700.00),
(6, 2, 1, 'Procesador AMD Athlon 3000G 3.5GHz', '1750865470.png', 'El AMD Athlon 3000G es un procesador económico con 2 núcleos y 4 hilos, ideal para PCs de oficina o multimedia. Incluye gráficos Radeon Vega 3 y alcanza 3.5 GHz. Perfecto para tareas básicas y sistemas de bajo costo con buen rendimiento gráfico integrado.', 20, 700.00, 700.00),
(7, 2, 2, 'Procesador Intel Core i3 12100F 4.3GHz', '1750865489.png', 'Intel Core i3 12100F con 4 núcleos y 8 hilos, ideal para gaming y productividad básica. Con arquitectura Alder Lake y hasta 4.3 GHz, ofrece gran rendimiento por su precio. No incluye gráficos integrados, perfecto para sistemas con GPU dedicada.', 20, 700.00, 700.00),
(8, 2, 2, 'Procesador Intel Core i5 12600KF 4.90GHz', '1750865514.png', 'El Intel Core i5 12600KF ofrece 10 núcleos (6P+4E) y 16 hilos, ideal para gaming y tareas exigentes. Con arquitectura Alder Lake y un boost de 4.9 GHz, asegura un rendimiento sobresaliente. Sin gráficos integrados, perfecto para configuraciones con GPU de alto nivel.', 20, 700.00, 700.00),
(9, 2, 2, 'Procesador Intel Core i7 10700K 5.1GHz', '1750865535.png', 'Intel Core i7 10700K con 8 núcleos y 16 hilos, diseñado para gaming y creación de contenido. Alcanza hasta 5.1 GHz con arquitectura Comet Lake y desbloqueado para overclocking. Incluye gráficos UHD 630, ideal para sistemas versátiles de alto rendimiento.', 20, 700.00, 700.00),
(10, 2, 2, 'Procesador Intel Core i9 14900F 5.8GHz', '1750865554.png', 'El Intel Core i9 14900F es un procesador tope de gama con 24 núcleos (8P+16E) y 32 hilos, perfecto para profesionales y gamers extremos. Con arquitectura Raptor Lake Refresh y hasta 5.8 GHz, ofrece potencia inigualable. Sin gráficos integrados, ideal para GPUs dedicadas.', 20, 700.00, 700.00),
(11, 3, 8, 'Memoria Team DDR5 64GB (2x32GB) Black Intel', '1750865576.png', 'Kit de memoria Team DDR5 de 64GB (2x32GB) en color negro, optimizado para plataformas Intel. Ofrece alta velocidad y baja latencia para gaming, edición de video y aplicaciones pesadas. Compatible con XMP para overclocking sencillo y rendimiento estable.', 20, 700.00, 700.00),
(12, 3, 8, 'Memoria Team DDR5 64GB (2x32GB) RGB Black Intel', '1750865602.png', 'Memoria Team DDR5 de 64GB (2x32GB) con iluminación RGB personalizable, diseñada para Intel. Ideal para sistemas de alto rendimiento, ofrece velocidades rápidas y gran capacidad para multitarea intensiva. Soporta XMP y disipadores para mantener temperaturas óptimas.', 20, 700.00, 700.00),
(13, 3, 8, 'Memoria Team DDR5 64GB (2x32GB) Red Intel', '1750865619.png', 'Kit de memoria Team DDR5 de 64GB (2x32GB) en color rojo, optimizado para procesadores Intel. Proporciona alto rendimiento para gaming y creación de contenido, con soporte para perfiles XMP y disipadores térmicos para una operación estable bajo cargas pesadas.', 20, 700.00, 700.00),
(14, 3, 8, 'Memoria Team DDR5 64GB (2x32GB) White Intel', '1750865635.png', 'Memoria Team DDR5 de 64GB (2x32GB) en color blanco, diseñada para plataformas Intel. Ofrece gran capacidad y velocidad para aplicaciones exigentes como edición 3D y streaming. Compatible con XMP y con disipadores para un estilo elegante y rendimiento confiable.', 20, 700.00, 700.00),
(15, 1, 6, 'Mother ASUS ROG STRIX X870-A GAMING WIFI DDR5 AM5', '1750865714.png', 'Placa base ASUS ROG STRIX X870-A con socket AM5, compatible con procesadores AMD Ryzen 7000/8000. Soporta DDR5 y PCIe 5.0, ideal para gaming y overclocking. Incluye WiFi 6E, USB 4.0 y un robusto VRM para máxima estabilidad en configuraciones de alto rendimiento.', 20, 700.00, 700.00),
(16, 1, 4, 'Mother Asrock B550M Pro4 AM4', '1750865744.png', 'La Asrock B550M Pro4 es una placa base Micro ATX con socket AM4, compatible con procesadores AMD Ryzen de 3ra y 4ta generación. Soporta DDR4, PCIe 4.0 y M.2 NVMe, ideal para PCs gamer compactos con buena relación calidad-precio.', 20, 700.00, 700.00),
(17, 1, 4, 'Mother Asrock B550 Phantom Gaming 4', '1750865769.png', 'Placa base Asrock B550 Phantom Gaming 4 con socket AM4, diseñada para gamers. Compatible with Ryzen 3000/5000, soporta DDR4 hasta 4733 MHz y PCIe 4.0. Incluye conectividad M.2 y un diseño robusto para un rendimiento estable en juegos y multitarea.', 20, 700.00, 700.00),
(18, 1, 6, 'Mother ASUS PRIME A520M-K DDR4 AM4', '1750865841.png', 'La ASUS PRIME A520M-K es una placa base Micro ATX con socket AM4, ideal para PCs económicos con procesadores Ryzen 3000/5000. Soporta DDR4 y PCIe 3.0, con conectividad M.2 y USB 3.2 Gen 1, perfecta para configuraciones básicas y fiables.', 20, 700.00, 700.00),
(19, 1, 6, 'Mother ASUS ROG MAXIMUS Z890 HERO LGA1851', '1750865891.png', 'Placa base premium ASUS ROG MAXIMUS Z890 HERO con socket LGA1851 para procesadores Intel Core de 15ta generación. Soporta DDR5, PCIe 5.0 y WiFi 7. Con VRM avanzado y refrigeración optimizada, es ideal para gaming extremo y overclocking profesional.', 20, 700.00, 700.00),
(20, 1, 4, 'Mother Asrock Z890 TAICHI LGA1851 DDR5', '1750865916.png', 'La Asrock Z890 TAICHI con socket LGA1851 es una placa base de alta gama para procesadores Intel Core de última generación. Soporta DDR5, PCIe 5.0 y múltiples M.2. Con WiFi 7 y un diseño elegante, es perfecta para entusiastas y creadores de contenido.', 20, 700.00, 700.00),
(21, 1, 6, 'Mother ASUS ROG STRIX Z890-E GAMING WIFI LGA1851', '1750865955.png', 'Placa base ASUS ROG STRIX Z890-E con socket LGA1851, diseñada para Intel Core de 15ta generación. Ofrece soporte para DDR5, PCIe 5.0, WiFi 6E y USB 4.0. Con un VRM robusto, es ideal para gaming de alto nivel y configuraciones personalizadas.', 20, 700.00, 700.00),
(22, 1, 6, 'Mother ASUS ROG MAXIMUS Z790 HERO LGA1700 DDR5', '1750865972.png', 'La ASUS ROG MAXIMUS Z790 HERO con socket LGA1700 es compatible con procesadores Intel Core de 12ta/13ta generación. Soporta DDR5, PCIe 5.0 y WiFi 6E. Con refrigeración avanzada y conectividad premium, es perfecta para gaming y workstations de alto rendimiento.', 20, 700.00, 700.00),
(23, 1, 6, 'Mother ASUS ROG STRIX Z890-F GAMING WIFI LGA1851', '1750865994.png', 'Placa base ASUS ROG STRIX Z890-F con socket LGA1851 para procesadores Intel Core de última generación. Soporta DDR5, PCIe 5.0 y WiFi 7, con un diseño optimizado para gaming. Incluye conectividad avanzada y refrigeración eficiente para un rendimiento estable.', 20, 700.00, 700.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_tag`
--

CREATE TABLE `product_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product_tag`
--

INSERT INTO `product_tag` (`id`, `product_id`, `tag_id`) VALUES
(100, 2, 1),
(101, 2, 2),
(102, 3, 1),
(103, 3, 2),
(104, 3, 3),
(105, 4, 1),
(106, 4, 2),
(107, 4, 3),
(108, 5, 1),
(109, 5, 2),
(110, 5, 3),
(111, 6, 1),
(112, 7, 1),
(113, 7, 2),
(114, 8, 1),
(115, 8, 2),
(116, 8, 3),
(117, 9, 1),
(118, 9, 2),
(119, 9, 3),
(120, 10, 1),
(121, 10, 2),
(122, 10, 3),
(123, 11, 2),
(124, 12, 2),
(125, 13, 2),
(126, 14, 2),
(127, 15, 2),
(128, 15, 3),
(129, 15, 4),
(130, 16, 1),
(131, 16, 2),
(132, 17, 1),
(133, 17, 2),
(134, 18, 2),
(135, 19, 1),
(136, 19, 2),
(137, 19, 3),
(138, 19, 4),
(139, 20, 1),
(140, 20, 2),
(141, 20, 3),
(142, 21, 1),
(143, 21, 2),
(144, 21, 3),
(145, 21, 4),
(146, 22, 1),
(147, 22, 2),
(148, 22, 3),
(149, 22, 4),
(150, 23, 1),
(151, 23, 2),
(152, 23, 3),
(153, 23, 4),
(155, 1, 1),
(156, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag`
--

CREATE TABLE `tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(2, 'Gamer'),
(1, 'Oferta'),
(3, 'Overclock'),
(4, 'RGB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'TomasSorgetti', 'tomassorgetti456@gmail.com', '$2y$10$SVe07e0Tcbw5raNG6QG5xuOKMXff7feSKVajz4.VyeFZUS0HkYTca', 'superadmin'),
(2, 'asdasd', 'tomassorgetti@gmail.coma', '$2y$10$Xy/wKLtr22RFt582OxClvuoQcMc10qiSpj5c8i1qsK6BUbBzr4dcO', 'user'),
(4, 'asdasdasdasd', 'tomassorgetti@gmail.com', '$2y$10$Pt6PfIyZKqjnUvCW8ev4iun87VlWsJNimlyIKI0Lg6DU2pG1UT7Hi', 'user'),
(5, '123', 'asd@gmail.com', '$2y$10$P8eCAbR.AZWqaRLWwTrQ8OAlWQxgPi/sp2LYNOdE4mGNeX7HQ9NLu', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `path` (`path`);

--
-- Indices de la tabla `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `path` (`path`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indices de la tabla `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indices de la tabla `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `page`
--
ALTER TABLE `page`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
