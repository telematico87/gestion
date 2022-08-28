-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2022 a las 07:28:36
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `salessystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_access_tokens`
--

CREATE TABLE `auth_access_tokens` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `scopes` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(5) NOT NULL,
  `name` varchar(35) NOT NULL,
  `description` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `modified_at`) VALUES
(1, 'smartphones', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit sapiente corrup', '2022-04-09 15:36:11', NULL),
(2, 'Tablets', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit sapiente corrup', '2022-04-09 15:39:12', NULL),
(3, ' Laptops', 'Cupiditate neque provident iure fuga, necessitatibus officia laudantium! Quo vol', '2022-04-09 15:41:03', NULL),
(4, 'Smart Watch', ' consectetur adipisicing elit. Esse sunt dolorum assumenda distinctio qui expli', '2022-04-09 15:42:29', NULL),
(5, 'Monitores', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio, ab dolo', '2022-04-09 15:43:41', NULL),
(6, 'Mouse Pads', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio, ab dolo', '2022-04-09 15:57:30', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type_document` varchar(20) NOT NULL,
  `num_document` varchar(20) NOT NULL,
  `address` varchar(80) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `name`, `type_document`, `num_document`, `address`, `phone_number`, `email`, `created_at`, `modified_at`) VALUES
(1, 'Bradley Olson', 'DNI', '80873617', 'Av.  Bradley Olson', '3670990171', 'bradleyolson@gmail.com', '2022-04-09 21:47:11', '0000-00-00 00:00:00'),
(2, 'Jordan Bell', 'RUC', '071133250016109', 'Av. Jordan Bell', '2717511271', 'Jordanbell@gmail.com', '2022-04-09 21:48:22', '0000-00-00 00:00:00'),
(3, 'Medina Lopez', 'DNI', '68390972', 'Av. Medina Lopez', '5822868329', 'medinalopez@gmail.com', '2022-04-09 21:49:31', '0000-00-00 00:00:00'),
(4, 'Arnold James', 'DNI', '04081187', 'Av. Arnold James', '3322277226', 'arnoldjames@gmail.com', '2022-04-09 21:50:43', '0000-00-00 00:00:00'),
(5, 'Jackson Mason', 'RUC', '669061758860122', 'Av. Jackson Mason', '6321328882', 'jacksonmason@gmail.com', '2022-04-09 21:51:41', '0000-00-00 00:00:00'),
(6, 'Wallace Thompson', 'RUC', '353073866764423', 'Av. Wallace Thompson', '8787394878', 'wallacethompson@gmail.com', '2022-04-09 21:54:10', '0000-00-00 00:00:00'),
(7, 'Sullivan James', 'RUC', '670481909491130', 'Av. Sullivan James', '7453147342', 'sullivanjames@gmail.com', '2022-04-09 21:55:52', '0000-00-00 00:00:00'),
(8, 'Phillips Owens', 'DNI', '94443774', 'Av, Phillips Owens', '4315660490', 'phillipsowens@gmail.com', '2022-04-09 21:57:02', '0000-00-00 00:00:00'),
(9, 'Edwards Richard', 'DNI', '86399743', 'Av. Edwards Richard', '1748609075', 'edwardsrichard@gmail.com', '2022-04-09 21:58:12', '0000-00-00 00:00:00'),
(10, 'Reid Wells', 'RUC', '069317083471227', 'Av. Reid Wells', '0978160262', 'reidwells@gmail.com', '2022-04-09 21:59:27', '0000-00-00 00:00:00'),
(11, 'Carolyn Collins', 'RUC', '838355201041908', 'Av. Carolyn Collins', '8028923510', 'carolyncollins@gmail.com', '2022-04-09 22:01:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `barcode` varchar(15) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price_purchase` float NOT NULL,
  `price_sale` float NOT NULL,
  `stock` int(5) NOT NULL DEFAULT 0,
  `picture` varchar(160) NOT NULL,
  `category_id` int(5) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `barcode`, `name`, `description`, `price_purchase`, `price_sale`, `stock`, `picture`, `category_id`, `created_at`, `modified_at`) VALUES
(17, '4588562801', 'ProArt Studiobook Pro X W730', 'ProArt StudioBook Pro X is the first Quadro®-powered laptop to feature the four-sided NanoEdge display, making it a mighty powerhouse that brings ideas to life. The innovative slim-bezel NanoEdge design allows a larger panel to fit into its compact chassis for immersive visuals.', 4500.5, 4590.8, 23, 'http://localhost:8080/assets/img/product/1ba87e8c40a8e91f2df82b66f7fb5e2f.png', 3, '2022-04-09 15:59:58', NULL),
(18, '2756662765', 'Zenbook Pro Duo 15 OLED (UX582, 12th Gen', 'ZenBook Pro Duo 15 OLED lets you get things done in style: calmly, efficiently, and with zero fuss. It’s your powerful and elegant next-level companion for on-the-go productivity', 1580.4, 1720.9, 13, 'http://localhost:8080/assets/img/product/a824605b268b877abc88b8e2b4db3695.png', 3, '2022-04-09 16:25:58', NULL),
(19, '2144066134', 'ThinkPad L13 2da Gen (13.3”, Intel)', 'Consectetur adipisicing elit. Esse sunt dolorum assumenda distinctio qui, explicabo, quas, harum inventore similique eum cum', 450.7, 469.99, 12, 'http://localhost:8080/assets/img/product/10733e059786d343c1e624daccdf2ad4.png', 3, '2022-04-09 16:37:30', NULL),
(20, '7258688913', 'ROG Zephyrus Duo 16 (2022)', 'True multitasking with a seamless 14.1” touchscreen secondary display', 3250.8, 3400.9, 18, 'http://localhost:8080/assets/img/product/527b0450a24a94e52b05c845a9a694bf.png', 3, '2022-04-09 16:49:48', NULL),
(21, '6760943830', 'Acer Nitro Core i5', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 2580.9, 2650.2, 13, 'http://localhost:8080/assets/img/product/cca63e31bf1bdf538fb04027e31da6c4.png', 3, '2022-04-09 17:09:47', NULL),
(22, '1757708576', 'iPhone 13 Pro', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 1250.45, 1380.35, 17, 'http://localhost:8080/assets/img/product/c9534b396e88cf5fd745d10900e70e37.png', 1, '2022-04-09 17:14:08', '2022-04-09 05:33:18'),
(23, '3984431209', 'Galaxy S22 Ultra', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 1180.32, 1240.45, 10, 'http://localhost:8080/assets/img/product/3f7e90ed422e644c57217dce4fa340a1.png', 1, '2022-04-09 17:20:16', '2022-04-09 05:34:49'),
(24, '1957507335', 'xiaomi poco x3 pro', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 0, 0, 0, 'http://localhost:8080/assets/img/product/398a6aeb516a0f9a7be133d72bcc9d61.png', 1, '2022-04-09 17:33:23', NULL),
(25, '2961640905', 'HUAWEI MateView GT 34 pulgadas Estándar', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim.', 0, 0, 0, 'http://localhost:8080/assets/img/product/c5a9e4e36008ef27c822b77d989b790c.png', 5, '2022-04-09 17:35:02', NULL),
(26, '3812540664', 'Monitor Curvo Ultrapanorámico 49', 'El monitor CJ89 de 49 de Samsung proporciona una visión sin igual. Con su pantalla curva de ratio de aspecto.', 1120.24, 1200, 14, 'http://localhost:8080/assets/img/product/2bff1c128426ee3dfccebd200a050bd1.png', 1, '2022-04-09 18:05:56', NULL),
(27, '3055004772', 'Galaxy Tab S8 Ultra', 'La Galaxy Tab S más grande hasta el momento está diseñada para que puedas crear como un profesional. Dispara con nuestra primera cámara frontal Ultra Gran Angular y edita en la pantalla más grande.', 0, 0, 0, 'http://localhost:8080/assets/img/product/3aca734c5ea53df6e81fe64719a49bb5.png', 2, '2022-04-09 18:16:57', '2022-04-09 06:38:32'),
(28, '7513098492', 'iPad Pro', 'The ultimate iPad experience. Now with breakthrough M1 performance, a breathtaking XDR display, and blazing‑fast 5G wireless. Buckle up.', 980.5, 990.99, 43, 'http://localhost:8080/assets/img/product/81157bd398f337f890d7a931f64e986d.png', 2, '2022-04-09 18:37:44', NULL),
(29, '3835754877', 'HUAWEI MatePad 11 Grey 6GB+128GB', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim.', 890.6, 940.5, 9, 'http://localhost:8080/assets/img/product/6b3bca51794717d697ade818d9557c55.png', 2, '2022-04-09 18:46:50', NULL),
(30, '1628829326', 'Apple Watch Series 7', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim.', 720.6, 790.9, 9, 'http://localhost:8080/assets/img/product/4a6d85f3029aa41efcdbf016fe20b642.png', 4, '2022-04-09 18:48:02', NULL),
(31, '9480576613', 'Mouse iMICE ergonómico USB', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim', 50.9, 58.99, 49, 'http://localhost:8080/assets/img/product/5c72059827d153683cddb8eb29ff275d.png', 6, '2022-04-09 19:06:08', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

CREATE TABLE `purchase` (
  `id` int(10) NOT NULL,
  `subtotal` float NOT NULL,
  `igv` float NOT NULL,
  `total` float NOT NULL,
  `user_id` int(5) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `voucher_id` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`id`, `subtotal`, `igv`, `total`, `user_id`, `supplier_id`, `voucher_id`, `date`) VALUES
(6, 97369.2, 17526.5, 114896, 1, 1, 1, '2022-04-10 00:28:44'),
(7, 151226, 27220.7, 178447, 1, 3, 1, '2022-04-10 00:31:37'),
(8, 42220.6, 7599.71, 49820.3, 1, 4, 1, '2022-04-10 02:42:45'),
(9, 42161.5, 7589.07, 49750.6, 1, 5, 1, '2022-04-10 03:16:34'),
(10, 28254.6, 5085.83, 33340.4, 1, 3, 1, '2022-04-10 03:20:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `id` int(15) NOT NULL,
  `purchase_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `cant` int(11) NOT NULL,
  `amount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `purchase_detail`
--

INSERT INTO `purchase_detail` (`id`, `purchase_id`, `product_id`, `cant`, `amount`) VALUES
(1, 6, 20, 20, 65016),
(2, 6, 18, 15, 23706),
(3, 6, 30, 12, 8647),
(4, 7, 21, 15, 38714),
(5, 7, 17, 25, 112513),
(6, 8, 19, 12, 5408),
(7, 8, 22, 20, 25009),
(8, 8, 23, 10, 11803),
(9, 9, 28, 43, 42162),
(10, 10, 31, 50, 2545),
(11, 10, 26, 15, 16804),
(12, 10, 29, 10, 8906);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(1) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale`
--

CREATE TABLE `sale` (
  `id` int(10) NOT NULL,
  `subtotal` varchar(10) NOT NULL,
  `igv` varchar(10) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `total` varchar(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `voucher_id` int(1) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sale`
--

INSERT INTO `sale` (`id`, `subtotal`, `igv`, `discount`, `total`, `user_id`, `client_id`, `voucher_id`, `date`) VALUES
(1, '3400.90', '612.16', '', '4013.06', 1, 3, 1, '2022-10-09 22:02:18'),
(2, '3441.80', '619.52', '', '4061.32', 1, 5, 1, '2022-09-09 22:02:33'),
(3, '2171.25', '390.82', '', '2562.07', 1, 8, 1, '2022-06-09 22:02:52'),
(4, '4590.80', '0.00', '100', '4490.80', 1, 4, 2, '2022-04-09 22:03:50'),
(5, '5300.40', '954.07', '', '6254.47', 1, 7, 1, '2022-05-09 22:04:05'),
(6, '1380.35', '248.46', '', '1628.81', 1, 3, 1, '2022-08-09 22:11:16'),
(7, '790.90', '142.36', '', '933.26', 1, 10, 1, '2022-07-09 22:12:16'),
(8, '3400.90', '612.16', '', '4013.06', 1, 1, 1, '2021-08-09 22:12:35'),
(9, '6762.05', '1217.17', '', '7979.22', 1, 11, 1, '2021-08-09 22:13:34'),
(10, '999.49', '0.00', '', '999.49', 1, 2, 2, '2021-07-09 22:20:57'),
(11, '1200.00', '216.00', '80', '1336.00', 1, 5, 1, '2021-06-09 22:21:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_detail`
--

CREATE TABLE `sale_detail` (
  `id` int(15) NOT NULL,
  `sale_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `cant` int(10) NOT NULL,
  `amount` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sale_detail`
--

INSERT INTO `sale_detail` (`id`, `sale_id`, `product_id`, `cant`, `amount`) VALUES
(1, 1, 20, 1, '3400.90'),
(2, 2, 18, 2, '3441.80'),
(3, 3, 22, 1, '1380.35'),
(4, 3, 30, 1, '790.90'),
(5, 4, 17, 1, '4590.80'),
(6, 5, 21, 2, '5300.40'),
(7, 6, 22, 1, '1380.35'),
(8, 7, 30, 1, '790.90'),
(9, 8, 20, 1, '3400.90'),
(10, 9, 30, 1, '790.90'),
(11, 9, 22, 1, '1380.35'),
(12, 9, 17, 1, '4590.80'),
(13, 10, 31, 1, '58.99'),
(14, 10, 29, 1, '940.50'),
(15, 11, 26, 1, '1200.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `email` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `ruc`, `phone_number`, `email`, `created_at`, `modified_at`) VALUES
(1, 'Amazon', '107890926723425', '59045729', 'amazon@gmail.com', '2022-04-10 03:09:07', '0000-00-00 00:00:00'),
(2, 'Computer Center', '850609220221547', '87108651', 'computercenter@gmail.com', '2022-04-10 03:09:15', '0000-00-00 00:00:00'),
(3, 'Ali Express', '912333759941013', '30810418', 'aliexpress@gmail.com', '2022-04-10 03:09:24', '0000-00-00 00:00:00'),
(4, 'PC ventas mark', '028043782449555', '06043618', 'allpcventas@gmail.com', '2022-04-10 03:10:57', '0000-00-00 00:00:00'),
(5, 'Linio pc', '310815346917335', '43823925', 'liniopc@gmail.com', '2022-04-10 03:09:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(160) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `rol_id` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone_number`, `address`, `picture`, `rol_id`, `created_at`, `remember_token`, `updated_at`, `deleted_at`) VALUES
(1, 'primerusuario', 'primerusuario@gmail.com', '$2y$10$PJie95n4Brbig.IEUHcZc.94U3.MUrw2HQt8.CHdlenHcu92FjXMq', 'Lights Thing', '12345678', '', 'http://localhost:8080/assets/img/profile/50034bd20ef09138e2ff633365ea6879.png', 1, NULL, '5e0959d4f8cd93f98ebe0abc71568c6a7ec85257', '2022-04-09 22:50:26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voucher`
--

CREATE TABLE `voucher` (
  `id` int(5) NOT NULL,
  `name` varchar(10) NOT NULL,
  `igv` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `voucher`
--

INSERT INTO `voucher` (`id`, `name`, `igv`) VALUES
(1, 'Factura', 18),
(2, 'Boleta', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_access_tokens`
--
ALTER TABLE `auth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `voucher_id` (`voucher_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_id` (`voucher_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auth_access_tokens`
--
ALTER TABLE `auth_access_tokens`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sale_detail`
--
ALTER TABLE `sale_detail`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`),
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD CONSTRAINT `purchase_detail_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`),
  ADD CONSTRAINT `purchase_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Filtros para la tabla `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`),
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD CONSTRAINT `sale_detail_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`),
  ADD CONSTRAINT `sale_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
