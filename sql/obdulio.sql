/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : 127.0.0.1:3306
 Source Schema         : obdulio

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 16/12/2019 15:47:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for destino
-- ----------------------------
DROP TABLE IF EXISTS `destino`;
CREATE TABLE `destino`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_81F64EFA3A909126`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of destino
-- ----------------------------
INSERT INTO `destino` VALUES (3, 'AA');
INSERT INTO `destino` VALUES (1, 'Acop');
INSERT INTO `destino` VALUES (6, 'AUT');
INSERT INTO `destino` VALUES (2, 'CS');
INSERT INTO `destino` VALUES (5, 'Fer');
INSERT INTO `destino` VALUES (4, 'Merc');

-- ----------------------------
-- Table structure for medida
-- ----------------------------
DROP TABLE IF EXISTS `medida`;
CREATE TABLE `medida`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_9C1C2A8C3A909126`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medida
-- ----------------------------
INSERT INTO `medida` VALUES (2, 'Bulto');
INSERT INTO `medida` VALUES (1, 'libra');
INSERT INTO `medida` VALUES (4, 'Pingal');
INSERT INTO `medida` VALUES (3, 'Saco');

-- ----------------------------
-- Table structure for planificacionproduccion
-- ----------------------------
DROP TABLE IF EXISTS `planificacionproduccion`;
CREATE TABLE `planificacionproduccion`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_producto` int(11) NULL DEFAULT NULL,
  `fk_unidad` int(11) NULL DEFAULT NULL,
  `enero` double NOT NULL,
  `febrero` double NOT NULL,
  `marzo` double NOT NULL,
  `abril` double NOT NULL,
  `mayo` double NOT NULL,
  `junio` double NOT NULL,
  `julio` double NOT NULL,
  `agosto` double NOT NULL,
  `septiembre` double NOT NULL,
  `octubre` double NOT NULL,
  `noviembre` double NOT NULL,
  `diciembre` double NOT NULL,
  `anno` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_60B16643959345CB`(`fk_producto`) USING BTREE,
  INDEX `IDX_60B16643D348B8BF`(`fk_unidad`) USING BTREE,
  CONSTRAINT `FK_60B16643959345CB` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_60B16643D348B8BF` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of planificacionproduccion
-- ----------------------------
INSERT INTO `planificacionproduccion` VALUES (1, 1, 1, 3, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2019);
INSERT INTO `planificacionproduccion` VALUES (4, 2, 1, 6, 5, 6, 6, 7, 5, 1, 6, 8, 1, 3, 4, 2019);
INSERT INTO `planificacionproduccion` VALUES (6, 3, 2, 51, 5, 1, 65, 1, 6, 6, 516, 5165, 1, 51, 651, 2019);
INSERT INTO `planificacionproduccion` VALUES (7, 8, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 80, 2019);

-- ----------------------------
-- Table structure for produccion
-- ----------------------------
DROP TABLE IF EXISTS `produccion`;
CREATE TABLE `produccion`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_producto` int(11) NULL DEFAULT NULL,
  `fk_destino` int(11) NULL DEFAULT NULL,
  `fk_unidad` int(11) NULL DEFAULT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `factura` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_1E23DEC6F9EBA009`(`factura`) USING BTREE,
  INDEX `IDX_1E23DEC6959345CB`(`fk_producto`) USING BTREE,
  INDEX `IDX_1E23DEC671D973D6`(`fk_destino`) USING BTREE,
  INDEX `IDX_1E23DEC6D348B8BF`(`fk_unidad`) USING BTREE,
  CONSTRAINT `FK_1E23DEC671D973D6` FOREIGN KEY (`fk_destino`) REFERENCES `destino` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_1E23DEC6959345CB` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_1E23DEC6D348B8BF` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produccion
-- ----------------------------
INSERT INTO `produccion` VALUES (1, 1, 3, 1, '2019-12-07', 3455, '34534');
INSERT INTO `produccion` VALUES (2, 2, 6, 2, '2018-02-04', 35, 'dsfsdf');
INSERT INTO `produccion` VALUES (3, 8, 1, 2, '2019-12-12', 32, 'asdqw');
INSERT INTO `produccion` VALUES (4, 3, 1, 1, '2019-12-12', 65, 'qwezxc');
INSERT INTO `produccion` VALUES (5, 2, 2, 1, '2019-12-12', 12, '1324425');
INSERT INTO `produccion` VALUES (6, 8, 5, 3, '2019-12-06', 63, 'F-Prueba#1');

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tipoproducto` int(11) NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fk_medida` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_A7BB06153A909126`(`nombre`) USING BTREE,
  INDEX `IDX_A7BB0615E1D7C4D1`(`fk_tipoproducto`) USING BTREE,
  INDEX `IDX_A7BB0615BCB2421C`(`fk_medida`) USING BTREE,
  CONSTRAINT `FK_A7BB0615BCB2421C` FOREIGN KEY (`fk_medida`) REFERENCES `medida` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_A7BB0615E1D7C4D1` FOREIGN KEY (`fk_tipoproducto`) REFERENCES `tipoproducto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 2, 'producto 0', 1);
INSERT INTO `producto` VALUES (2, 1, 'producto 1', 1);
INSERT INTO `producto` VALUES (3, 2, 'producto 3', 1);
INSERT INTO `producto` VALUES (8, 3, 'producto 4', 1);

-- ----------------------------
-- Table structure for tipodeunidad
-- ----------------------------
DROP TABLE IF EXISTS `tipodeunidad`;
CREATE TABLE `tipodeunidad`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_CD98A33B3A909126`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipodeunidad
-- ----------------------------
INSERT INTO `tipodeunidad` VALUES (2, 'CPA');
INSERT INTO `tipodeunidad` VALUES (3, 'CSS');
INSERT INTO `tipodeunidad` VALUES (1, 'UBPC');

-- ----------------------------
-- Table structure for tipoproducto
-- ----------------------------
DROP TABLE IF EXISTS `tipoproducto`;
CREATE TABLE `tipoproducto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_C00AC6C83A909126`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipoproducto
-- ----------------------------
INSERT INTO `tipoproducto` VALUES (2, 'Frutas');
INSERT INTO `tipoproducto` VALUES (1, 'Hortalizas');
INSERT INTO `tipoproducto` VALUES (3, 'Viandas');

-- ----------------------------
-- Table structure for unidad
-- ----------------------------
DROP TABLE IF EXISTS `unidad`;
CREATE TABLE `unidad`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fk_tipodeunidad` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_F3E6D02F3A909126`(`nombre`) USING BTREE,
  INDEX `IDX_F3E6D02FEC45A122`(`fk_tipodeunidad`) USING BTREE,
  CONSTRAINT `FK_F3E6D02FEC45A122` FOREIGN KEY (`fk_tipodeunidad`) REFERENCES `tipodeunidad` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unidad
-- ----------------------------
INSERT INTO `unidad` VALUES (1, 'Des. Gan', 2);
INSERT INTO `unidad` VALUES (2, ' La Magdalena', 3);
INSERT INTO `unidad` VALUES (3, 'Paco y sus amigos', 1);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('ROLE_ADMINISTRADOR','ROLE_OPERADOR','ROLE_CONSULTANTE') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `movil` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `imei` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `creado` datetime(0) NOT NULL,
  `actualizado` datetime(0) NOT NULL,
  `ultimo_logueo` datetime(0) NULL DEFAULT NULL,
  `ultimo_deslogueo` datetime(0) NULL DEFAULT NULL,
  `nombre_completo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'admin', '$2y$12$RBtP90dX0AFEbG/wMxoate.Ock2wzdsgsN8jtm4weAJz2ZYyfucai', 'ROLE_ADMINISTRADOR', NULL, NULL, 1, 1, '2019-09-09 00:00:00', '2019-12-16 20:07:45', '2019-12-16 20:07:45', '2019-11-28 19:38:29', 'Administrador', 'avatar.jpg');
INSERT INTO `usuarios` VALUES (2, 'operador', '$2y$12$.k6KYevmTZcVxXJnZtPfYuE2oAyOgiyOtxT8bn.nnXcOmUh66qV2C', 'ROLE_OPERADOR', NULL, NULL, 1, 0, '2019-09-29 03:15:34', '2019-11-28 19:42:10', '2019-11-28 19:38:37', '2019-11-28 19:42:10', 'operador', 'avatar.jpg');
INSERT INTO `usuarios` VALUES (3, 'consultor', '$2y$12$vMQuC7opHyLMbMjh9K4haOR08YdBbN81eyTawafPwOhL9miLN1Qp2', 'ROLE_CONSULTANTE', NULL, NULL, 1, 0, '2019-09-29 03:16:12', '2019-11-19 20:20:15', '2019-11-19 20:20:08', '2019-11-19 20:20:15', 'Consultor', 'avatar.jpg');

SET FOREIGN_KEY_CHECKS = 1;
