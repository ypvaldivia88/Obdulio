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

 Date: 28/11/2019 15:09:27
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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of destino
-- ----------------------------
INSERT INTO `destino` VALUES (1, 'Granjas el pollon');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of planificacionproduccion
-- ----------------------------
INSERT INTO `planificacionproduccion` VALUES (1, 2, 1, 23, 12, 346, 54, 453, 3, 45, 746, 4, 34, 54, 75, 2019);
INSERT INTO `planificacionproduccion` VALUES (3, 4, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2019);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produccion
-- ----------------------------
INSERT INTO `produccion` VALUES (1, 2, 1, 1, '2019-11-21', 12, '11111');
INSERT INTO `produccion` VALUES (2, 2, 1, 1, '2019-11-21', 13, '11');
INSERT INTO `produccion` VALUES (3, 4, 1, 2, '2019-11-21', 1, '1');

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tipoproducto` int(11) NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_A7BB06153A909126`(`nombre`) USING BTREE,
  INDEX `IDX_A7BB0615E1D7C4D1`(`fk_tipoproducto`) USING BTREE,
  CONSTRAINT `FK_A7BB0615E1D7C4D1` FOREIGN KEY (`fk_tipoproducto`) REFERENCES `tipoproducto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 1, 'Tomate');
INSERT INTO `producto` VALUES (2, 2, 'Cerdo');
INSERT INTO `producto` VALUES (3, 3, 'Queso B');
INSERT INTO `producto` VALUES (4, 2, 'Res');

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
INSERT INTO `tipoproducto` VALUES (2, 'Carne');
INSERT INTO `tipoproducto` VALUES (3, 'Lacteo');
INSERT INTO `tipoproducto` VALUES (1, 'Vianda');

-- ----------------------------
-- Table structure for unidad
-- ----------------------------
DROP TABLE IF EXISTS `unidad`;
CREATE TABLE `unidad`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `UNIQ_F3E6D02F3A909126`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unidad
-- ----------------------------
INSERT INTO `unidad` VALUES (1, 'CPA Fulanita');
INSERT INTO `unidad` VALUES (2, 'UEB Menganita');

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
INSERT INTO `usuarios` VALUES (1, 'admin', '$2y$12$RBtP90dX0AFEbG/wMxoate.Ock2wzdsgsN8jtm4weAJz2ZYyfucai', 'ROLE_ADMINISTRADOR', NULL, NULL, 1, 1, '2019-09-09 00:00:00', '2019-11-27 20:05:56', '2019-11-27 20:05:56', '2019-09-29 03:16:24', 'Administrador', 'avatar.jpg');
INSERT INTO `usuarios` VALUES (2, 'operador', '$2y$12$.k6KYevmTZcVxXJnZtPfYuE2oAyOgiyOtxT8bn.nnXcOmUh66qV2C', 'ROLE_OPERADOR', NULL, NULL, 1, 0, '2019-09-29 03:15:34', '2019-09-29 03:15:34', NULL, NULL, 'operador', 'avatar.jpg');
INSERT INTO `usuarios` VALUES (3, 'consultor', '$2y$12$vMQuC7opHyLMbMjh9K4haOR08YdBbN81eyTawafPwOhL9miLN1Qp2', 'ROLE_CONSULTANTE', NULL, NULL, 1, 0, '2019-09-29 03:16:12', '2019-09-29 03:16:55', '2019-09-29 03:16:38', '2019-09-29 03:16:55', 'Consultor', 'avatar.jpg');

SET FOREIGN_KEY_CHECKS = 1;
