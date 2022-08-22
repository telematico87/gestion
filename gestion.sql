/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : gestion

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 21/08/2022 23:51:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `auth_access_tokens`;
CREATE TABLE `auth_access_tokens`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `token`(`token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'smartphones', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit sapiente corrup', '2022-04-09 15:36:11', NULL);
INSERT INTO `category` VALUES (2, 'Tablets', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit sapiente corrup', '2022-04-09 15:39:12', NULL);
INSERT INTO `category` VALUES (3, ' Laptops', 'Cupiditate neque provident iure fuga, necessitatibus officia laudantium! Quo vol', '2022-04-09 15:41:03', NULL);
INSERT INTO `category` VALUES (4, 'Smart Watch', ' consectetur adipisicing elit. Esse sunt dolorum assumenda distinctio qui expli', '2022-04-09 15:42:29', NULL);
INSERT INTO `category` VALUES (5, 'Monitores', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio, ab dolo', '2022-04-09 15:43:41', NULL);
INSERT INTO `category` VALUES (6, 'Mouse Pads', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio, ab dolo', '2022-04-09 15:57:30', NULL);

-- ----------------------------
-- Table structure for client
-- ----------------------------
DROP TABLE IF EXISTS `client`;
CREATE TABLE `client`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type_document` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `num_document` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `date_birthday` date NOT NULL,
  `date_issue` date NOT NULL,
  `person_type` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `operator` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `service_type` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `father_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mather_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deparment` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `district` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of client
-- ----------------------------
INSERT INTO `client` VALUES (1, 'Bradley Olson', 'DNI', '80873617', 'Av.  Bradley Olson', '3670990171', 'bradleyolson@gmail.com', '2022-04-09 21:47:11', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (2, 'Jordan Bell', 'RUC', '071133250016109', 'Av. Jordan Bell', '2717511271', 'Jordanbell@gmail.com', '2022-04-09 21:48:22', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (3, 'Medina Lopez', 'DNI', '68390972', 'Av. Medina Lopez', '5822868329', 'medinalopez@gmail.com', '2022-04-09 21:49:31', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (4, 'Arnold James', 'DNI', '04081187', 'Av. Arnold James', '3322277226', 'arnoldjames@gmail.com', '2022-04-09 21:50:43', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (5, 'Jackson Mason', 'RUC', '669061758860122', 'Av. Jackson Mason', '6321328882', 'jacksonmason@gmail.com', '2022-04-09 21:51:41', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (6, 'Wallace Thompson', 'RUC', '353073866764423', 'Av. Wallace Thompson', '8787394878', 'wallacethompson@gmail.com', '2022-04-09 21:54:10', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (7, 'Sullivan James', 'RUC', '670481909491130', 'Av. Sullivan James', '7453147342', 'sullivanjames@gmail.com', '2022-04-09 21:55:52', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (8, 'Phillips Owens', 'DNI', '94443774', 'Av, Phillips Owens', '4315660490', 'phillipsowens@gmail.com', '2022-04-09 21:57:02', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (9, 'Edwards Richard', 'DNI', '86399743', 'Av. Edwards Richard', '1748609075', 'edwardsrichard@gmail.com', '2022-04-09 21:58:12', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (10, 'Reid Wells', 'RUC', '069317083471227', 'Av. Reid Wells', '0978160262', 'reidwells@gmail.com', '2022-04-09 21:59:27', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` VALUES (11, 'Carolyn Collins', 'RUC', '838355201041908', 'Av. Carolyn Collins', '8028923510', 'carolyncollins@gmail.com', '2022-04-09 22:01:47', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for operator
-- ----------------------------
DROP TABLE IF EXISTS `operator`;
CREATE TABLE `operator`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `code` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of operator
-- ----------------------------
INSERT INTO `operator` VALUES (0, 'Movistar', 'MOV');
INSERT INTO `operator` VALUES (2, 'Entel', 'ENT');
INSERT INTO `operator` VALUES (3, 'Bitel', 'BIT');

-- ----------------------------
-- Table structure for person_type
-- ----------------------------
DROP TABLE IF EXISTS `person_type`;
CREATE TABLE `person_type`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `code` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of person_type
-- ----------------------------
INSERT INTO `person_type` VALUES (1, 'Natural', 'NAT');
INSERT INTO `person_type` VALUES (2, 'Juridica', 'JUD');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price_purchase` float NOT NULL,
  `price_sale` float NOT NULL,
  `stock` int(5) NOT NULL DEFAULT 0,
  `picture` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int(5) NULL DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE,
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (17, '4588562801', 'ProArt Studiobook Pro X W730', 'ProArt StudioBook Pro X is the first Quadro®-powered laptop to feature the four-sided NanoEdge display, making it a mighty powerhouse that brings ideas to life. The innovative slim-bezel NanoEdge design allows a larger panel to fit into its compact chassis for immersive visuals.', 4500.5, 4590.8, 26, 'http://localhost:8080/assets/img/product/1ba87e8c40a8e91f2df82b66f7fb5e2f.png', 3, '2022-04-09 15:59:58', NULL);
INSERT INTO `product` VALUES (18, '2756662765', 'Zenbook Pro Duo 15 OLED (UX582, 12th Gen', 'ZenBook Pro Duo 15 OLED lets you get things done in style: calmly, efficiently, and with zero fuss. It’s your powerful and elegant next-level companion for on-the-go productivity', 1580.4, 1720.9, 12, 'http://localhost:8080/assets/img/product/a824605b268b877abc88b8e2b4db3695.png', 3, '2022-04-09 16:25:58', NULL);
INSERT INTO `product` VALUES (19, '2144066134', 'ThinkPad L13 2da Gen (13.3”, Intel)', 'Consectetur adipisicing elit. Esse sunt dolorum assumenda distinctio qui, explicabo, quas, harum inventore similique eum cum', 450.7, 469.99, 17, 'http://localhost:8080/assets/img/product/10733e059786d343c1e624daccdf2ad4.png', 3, '2022-04-09 16:37:30', NULL);
INSERT INTO `product` VALUES (20, '7258688913', 'ROG Zephyrus Duo 16 (2022)', 'True multitasking with a seamless 14.1” touchscreen secondary display', 3250.8, 3400.9, 18, 'http://localhost:8080/assets/img/product/527b0450a24a94e52b05c845a9a694bf.png', 3, '2022-04-09 16:49:48', NULL);
INSERT INTO `product` VALUES (21, '6760943830', 'Acer Nitro Core i5', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 2580.9, 2650.2, 11, 'http://localhost:8080/assets/img/product/cca63e31bf1bdf538fb04027e31da6c4.png', 3, '2022-04-09 17:09:47', NULL);
INSERT INTO `product` VALUES (22, '1757708576', 'iPhone 13 Pro', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 1250.45, 1380.35, 17, 'http://localhost:8080/assets/img/product/c9534b396e88cf5fd745d10900e70e37.png', 1, '2022-04-09 17:14:08', '2022-04-09 05:33:18');
INSERT INTO `product` VALUES (23, '3984431209', 'Galaxy S22 Ultra', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 1180.32, 1240.45, 10, 'http://localhost:8080/assets/img/product/3f7e90ed422e644c57217dce4fa340a1.png', 1, '2022-04-09 17:20:16', '2022-04-09 05:34:49');
INSERT INTO `product` VALUES (24, '1957507335', 'xiaomi poco x3 pro', 'Doloremque ullam ipsa assumenda atque molestias est repellat, iure, modi a natus facilis enim. Repellat eveniet perspiciatis molestias', 0, 0, 0, 'http://localhost:8080/assets/img/product/398a6aeb516a0f9a7be133d72bcc9d61.png', 1, '2022-04-09 17:33:23', NULL);
INSERT INTO `product` VALUES (25, '2961640905', 'HUAWEI MateView GT 34 pulgadas Estándar', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim.', 0, 0, 0, 'http://localhost:8080/assets/img/product/c5a9e4e36008ef27c822b77d989b790c.png', 5, '2022-04-09 17:35:02', NULL);
INSERT INTO `product` VALUES (26, '3812540664', 'Monitor Curvo Ultrapanorámico 49', 'El monitor CJ89 de 49 de Samsung proporciona una visión sin igual. Con su pantalla curva de ratio de aspecto.', 1120.24, 1200, 14, 'http://localhost:8080/assets/img/product/2bff1c128426ee3dfccebd200a050bd1.png', 1, '2022-04-09 18:05:56', NULL);
INSERT INTO `product` VALUES (27, '3055004772', 'Galaxy Tab S8 Ultra', 'La Galaxy Tab S más grande hasta el momento está diseñada para que puedas crear como un profesional. Dispara con nuestra primera cámara frontal Ultra Gran Angular y edita en la pantalla más grande.', 0, 0, 0, 'http://localhost:8080/assets/img/product/3aca734c5ea53df6e81fe64719a49bb5.png', 2, '2022-04-09 18:16:57', '2022-04-09 06:38:32');
INSERT INTO `product` VALUES (28, '7513098492', 'iPad Pro', 'The ultimate iPad experience. Now with breakthrough M1 performance, a breathtaking XDR display, and blazing‑fast 5G wireless. Buckle up.', 980.5, 990.99, 43, 'http://localhost:8080/assets/img/product/81157bd398f337f890d7a931f64e986d.png', 2, '2022-04-09 18:37:44', NULL);
INSERT INTO `product` VALUES (29, '3835754877', 'HUAWEI MatePad 11 Grey 6GB+128GB', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim.', 890.6, 940.5, 9, 'http://localhost:8080/assets/img/product/6b3bca51794717d697ade818d9557c55.png', 2, '2022-04-09 18:46:50', NULL);
INSERT INTO `product` VALUES (30, '1628829326', 'Apple Watch Series 7', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim.', 720.6, 790.9, 9, 'http://localhost:8080/assets/img/product/4a6d85f3029aa41efcdbf016fe20b642.png', 4, '2022-04-09 18:48:02', NULL);
INSERT INTO `product` VALUES (31, '9480576613', 'Mouse iMICE ergonómico USB', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias, iure tempore ipsa accusamus possimus nostrum quia saepe error deserunt vero enim', 50.9, 58.99, 49, 'http://localhost:8080/assets/img/product/5c72059827d153683cddb8eb29ff275d.png', 6, '2022-04-09 19:06:08', NULL);
INSERT INTO `product` VALUES (32, '33333', 'fdf', 'fdfdf', 0, 0, 0, 'http://localhost:8080/assets/img/product/8c5f6b019aca396c489d6cd905a6d1f4.PNG', 1, '2022-08-21 01:07:23', NULL);

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subtotal` float NOT NULL,
  `igv` float NOT NULL,
  `total` float NOT NULL,
  `user_id` int(5) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `voucher_id` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `supplier_id`(`supplier_id`) USING BTREE,
  INDEX `voucher_id`(`voucher_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase
-- ----------------------------
INSERT INTO `purchase` VALUES (6, 97369.2, 17526.5, 114896, 1, 1, 1, '2022-04-09 19:28:44');
INSERT INTO `purchase` VALUES (7, 151226, 27220.7, 178447, 1, 3, 1, '2022-04-09 19:31:37');
INSERT INTO `purchase` VALUES (8, 42220.6, 7599.71, 49820.3, 1, 4, 1, '2022-04-09 21:42:45');
INSERT INTO `purchase` VALUES (9, 42161.5, 7589.07, 49750.6, 1, 5, 1, '2022-04-09 22:16:34');
INSERT INTO `purchase` VALUES (10, 28254.6, 5085.83, 33340.4, 1, 3, 1, '2022-04-09 22:20:01');
INSERT INTO `purchase` VALUES (11, 15755, 2835.9, 18590.9, 1, 2, 1, '2022-08-21 02:07:28');

-- ----------------------------
-- Table structure for purchase_detail
-- ----------------------------
DROP TABLE IF EXISTS `purchase_detail`;
CREATE TABLE `purchase_detail`  (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `cant` int(11) NOT NULL,
  `amount` int(15) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  INDEX `purchase_id`(`purchase_id`) USING BTREE,
  CONSTRAINT `purchase_detail_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `purchase_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase_detail
-- ----------------------------
INSERT INTO `purchase_detail` VALUES (1, 6, 20, 20, 65016);
INSERT INTO `purchase_detail` VALUES (2, 6, 18, 15, 23706);
INSERT INTO `purchase_detail` VALUES (3, 6, 30, 12, 8647);
INSERT INTO `purchase_detail` VALUES (4, 7, 21, 15, 38714);
INSERT INTO `purchase_detail` VALUES (5, 7, 17, 25, 112513);
INSERT INTO `purchase_detail` VALUES (6, 8, 19, 12, 5408);
INSERT INTO `purchase_detail` VALUES (7, 8, 22, 20, 25009);
INSERT INTO `purchase_detail` VALUES (8, 8, 23, 10, 11803);
INSERT INTO `purchase_detail` VALUES (9, 9, 28, 43, 42162);
INSERT INTO `purchase_detail` VALUES (10, 10, 31, 50, 2545);
INSERT INTO `purchase_detail` VALUES (11, 10, 26, 15, 16804);
INSERT INTO `purchase_detail` VALUES (12, 10, 29, 10, 8906);
INSERT INTO `purchase_detail` VALUES (13, 11, 19, 2, 901);
INSERT INTO `purchase_detail` VALUES (14, 11, 17, 3, 13502);
INSERT INTO `purchase_detail` VALUES (15, 11, 19, 3, 1352);

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'Admin');
INSERT INTO `rol` VALUES (2, 'User');

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subtotal` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `igv` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discount` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `voucher_id` int(1) NOT NULL,
  `date` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `voucher_id`(`voucher_id`) USING BTREE,
  INDEX `client_id`(`client_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sale
-- ----------------------------
INSERT INTO `sale` VALUES (1, '3400.90', '612.16', '', '4013.06', 1, 3, 1, '2022-10-09 22:02:18');
INSERT INTO `sale` VALUES (2, '3441.80', '619.52', '', '4061.32', 1, 5, 1, '2022-09-09 22:02:33');
INSERT INTO `sale` VALUES (3, '2171.25', '390.82', '', '2562.07', 1, 8, 1, '2022-06-09 22:02:52');
INSERT INTO `sale` VALUES (4, '4590.80', '0.00', '100', '4490.80', 1, 4, 2, '2022-04-09 22:03:50');
INSERT INTO `sale` VALUES (5, '5300.40', '954.07', '', '6254.47', 1, 7, 1, '2022-05-09 22:04:05');
INSERT INTO `sale` VALUES (6, '1380.35', '248.46', '', '1628.81', 1, 3, 1, '2022-08-09 22:11:16');
INSERT INTO `sale` VALUES (7, '790.90', '142.36', '', '933.26', 1, 10, 1, '2022-07-09 22:12:16');
INSERT INTO `sale` VALUES (8, '3400.90', '612.16', '', '4013.06', 1, 1, 1, '2021-08-09 22:12:35');
INSERT INTO `sale` VALUES (9, '6762.05', '1217.17', '', '7979.22', 1, 11, 1, '2021-08-09 22:13:34');
INSERT INTO `sale` VALUES (10, '999.49', '0.00', '', '999.49', 1, 2, 2, '2021-07-09 22:20:57');
INSERT INTO `sale` VALUES (11, '1200.00', '216.00', '80', '1336.00', 1, 5, 1, '2021-06-09 22:21:34');
INSERT INTO `sale` VALUES (12, '7021.30', '1263.83', '', '8285.13', 1, 3, 1, '2022-08-21 02:06:14');

-- ----------------------------
-- Table structure for sale_detail
-- ----------------------------
DROP TABLE IF EXISTS `sale_detail`;
CREATE TABLE `sale_detail`  (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `cant` int(10) NOT NULL,
  `amount` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sale_id`(`sale_id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  CONSTRAINT `sale_detail_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `sale_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sale_detail
-- ----------------------------
INSERT INTO `sale_detail` VALUES (1, 1, 20, 1, '3400.90');
INSERT INTO `sale_detail` VALUES (2, 2, 18, 2, '3441.80');
INSERT INTO `sale_detail` VALUES (3, 3, 22, 1, '1380.35');
INSERT INTO `sale_detail` VALUES (4, 3, 30, 1, '790.90');
INSERT INTO `sale_detail` VALUES (5, 4, 17, 1, '4590.80');
INSERT INTO `sale_detail` VALUES (6, 5, 21, 2, '5300.40');
INSERT INTO `sale_detail` VALUES (7, 6, 22, 1, '1380.35');
INSERT INTO `sale_detail` VALUES (8, 7, 30, 1, '790.90');
INSERT INTO `sale_detail` VALUES (9, 8, 20, 1, '3400.90');
INSERT INTO `sale_detail` VALUES (10, 9, 30, 1, '790.90');
INSERT INTO `sale_detail` VALUES (11, 9, 22, 1, '1380.35');
INSERT INTO `sale_detail` VALUES (12, 9, 17, 1, '4590.80');
INSERT INTO `sale_detail` VALUES (13, 10, 31, 1, '58.99');
INSERT INTO `sale_detail` VALUES (14, 10, 29, 1, '940.50');
INSERT INTO `sale_detail` VALUES (15, 11, 26, 1, '1200.00');
INSERT INTO `sale_detail` VALUES (16, 12, 18, 1, '1720.90');
INSERT INTO `sale_detail` VALUES (17, 12, 21, 2, '5300.40');

-- ----------------------------
-- Table structure for service_type
-- ----------------------------
DROP TABLE IF EXISTS `service_type`;
CREATE TABLE `service_type`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `code` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of service_type
-- ----------------------------
INSERT INTO `service_type` VALUES (1, 'Movil', 'MOV');
INSERT INTO `service_type` VALUES (2, 'Hogar', 'HOG');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ruc` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'Amazon', '107890926723425', '59045729', 'amazon@gmail.com', '2022-04-09 22:09:07', '0000-00-00 00:00:00');
INSERT INTO `supplier` VALUES (2, 'Computer Center', '850609220221547', '87108651', 'computercenter@gmail.com', '2022-04-09 22:09:15', '0000-00-00 00:00:00');
INSERT INTO `supplier` VALUES (3, 'Ali Express', '912333759941013', '30810418', 'aliexpress@gmail.com', '2022-04-09 22:09:24', '0000-00-00 00:00:00');
INSERT INTO `supplier` VALUES (4, 'PC ventas mark', '028043782449555', '06043618', 'allpcventas@gmail.com', '2022-04-09 22:10:57', '0000-00-00 00:00:00');
INSERT INTO `supplier` VALUES (5, 'Linio pc', '310815346917335', '43823925', 'liniopc@gmail.com', '2022-04-09 22:09:34', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rol_id` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime NULL DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  INDEX `rol_id`(`rol_id`) USING BTREE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'primerusuario', 'primerusuario@gmail.com', '$2y$10$PJie95n4Brbig.IEUHcZc.94U3.MUrw2HQt8.CHdlenHcu92FjXMq', 'Lights Thing', '12345678', '', 'http://localhost:8080/assets/img/profile/50034bd20ef09138e2ff633365ea6879.png', 1, NULL, '997f0b5ed4fb1d0ea40c73d16cf1c6644b9e1c27', '2022-08-20 00:54:53', NULL);

-- ----------------------------
-- Table structure for voucher
-- ----------------------------
DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `igv` int(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of voucher
-- ----------------------------
INSERT INTO `voucher` VALUES (1, 'Factura', 18);
INSERT INTO `voucher` VALUES (2, 'Boleta', 0);

SET FOREIGN_KEY_CHECKS = 1;
