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
=======
/*
SQLyog Ultimate v9.63 
MySQL - 5.7.11 : Database - obdulio
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`obdulio` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `obdulio`;

/*Table structure for table `destino` */

DROP TABLE IF EXISTS `destino`;

CREATE TABLE `destino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81F64EFA3A909126` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `destino` */

insert  into `destino`(`id`,`nombre`) values (1,'destino'),(2,'destino1');

/*Table structure for table `medida` */

DROP TABLE IF EXISTS `medida`;

CREATE TABLE `medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9C1C2A8C3A909126` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `medida` */

insert  into `medida`(`id`,`nombre`) values (1,'libra');

/*Table structure for table `planificaciondeleche` */

DROP TABLE IF EXISTS `planificaciondeleche`;

CREATE TABLE `planificaciondeleche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_termo` int(11) DEFAULT NULL,
  `enero` int(11) NOT NULL,
  `febrero` int(11) NOT NULL,
  `marzo` int(11) NOT NULL,
  `abril` int(11) NOT NULL,
  `mayo` int(11) NOT NULL,
  `junio` int(11) NOT NULL,
  `julio` int(11) NOT NULL,
  `agosto` int(11) NOT NULL,
  `septiembre` int(11) NOT NULL,
  `octubre` int(11) NOT NULL,
  `noviembre` int(11) NOT NULL,
  `diciembre` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D859260D5D4E404B` (`fk_termo`),
  CONSTRAINT `FK_D859260D5D4E404B` FOREIGN KEY (`fk_termo`) REFERENCES `termo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `planificaciondeleche` */

/*Table structure for table `planificacionproduccion` */

DROP TABLE IF EXISTS `planificacionproduccion`;

CREATE TABLE `planificacionproduccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_producto` int(11) DEFAULT NULL,
  `fk_unidad` int(11) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `IDX_60B16643959345CB` (`fk_producto`),
  KEY `IDX_60B16643D348B8BF` (`fk_unidad`),
  CONSTRAINT `FK_60B16643959345CB` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `FK_60B16643D348B8BF` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `planificacionproduccion` */

/*Table structure for table `produccion` */

DROP TABLE IF EXISTS `produccion`;

CREATE TABLE `produccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_producto` int(11) DEFAULT NULL,
  `fk_destino` int(11) DEFAULT NULL,
  `fk_unidad` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `factura` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1E23DEC6F9EBA009` (`factura`),
  KEY `IDX_1E23DEC6959345CB` (`fk_producto`),
  KEY `IDX_1E23DEC671D973D6` (`fk_destino`),
  KEY `IDX_1E23DEC6D348B8BF` (`fk_unidad`),
  CONSTRAINT `FK_1E23DEC671D973D6` FOREIGN KEY (`fk_destino`) REFERENCES `destino` (`id`),
  CONSTRAINT `FK_1E23DEC6959345CB` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `FK_1E23DEC6D348B8BF` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `produccion` */

insert  into `produccion`(`id`,`fk_producto`,`fk_destino`,`fk_unidad`,`fecha`,`valor`,`factura`) values (2,2,2,2,'2018-02-04',546456,'dsfsdf');

/*Table structure for table `produccionleche` */

DROP TABLE IF EXISTS `produccionleche`;

CREATE TABLE `produccionleche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_termo` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  `factura` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2E17FD65D4E404B` (`fk_termo`),
  CONSTRAINT `FK_2E17FD65D4E404B` FOREIGN KEY (`fk_termo`) REFERENCES `termo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `produccionleche` */

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tipoproducto` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_medida` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A7BB06153A909126` (`nombre`),
  KEY `IDX_A7BB0615E1D7C4D1` (`fk_tipoproducto`),
  KEY `IDX_A7BB0615BCB2421C` (`fk_medida`),
  CONSTRAINT `FK_A7BB0615BCB2421C` FOREIGN KEY (`fk_medida`) REFERENCES `medida` (`id`),
  CONSTRAINT `FK_A7BB0615E1D7C4D1` FOREIGN KEY (`fk_tipoproducto`) REFERENCES `tipoproducto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `producto` */

insert  into `producto`(`id`,`fk_tipoproducto`,`nombre`,`fk_medida`) values (1,2,'producto 0',1),(2,1,'producto 1',1),(3,2,'producto 3',1),(8,1,'producto 4',1);

/*Table structure for table `termo` */

DROP TABLE IF EXISTS `termo`;

CREATE TABLE `termo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9CA3633E3A909126` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `termo` */

insert  into `termo`(`id`,`nombre`) values (2,'Termo');

/*Table structure for table `tipodeunidad` */

DROP TABLE IF EXISTS `tipodeunidad`;

CREATE TABLE `tipodeunidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CD98A33B3A909126` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipodeunidad` */

/*Table structure for table `tipoproducto` */

DROP TABLE IF EXISTS `tipoproducto`;

CREATE TABLE `tipoproducto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C00AC6C83A909126` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipoproducto` */

insert  into `tipoproducto`(`id`,`nombre`) values (2,'tipo de producto1'),(1,'tipo producto');

/*Table structure for table `unidad` */

DROP TABLE IF EXISTS `unidad`;

CREATE TABLE `unidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_tipodeunidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3E6D02F3A909126` (`nombre`),
  KEY `IDX_F3E6D02FEC45A122` (`fk_tipodeunidad`),
  CONSTRAINT `FK_F3E6D02FEC45A122` FOREIGN KEY (`fk_tipodeunidad`) REFERENCES `tipodeunidad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `unidad` */

insert  into `unidad`(`id`,`nombre`,`fk_tipodeunidad`) values (1,'Unidad1',NULL),(2,'unidad2',NULL);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('ROLE_ADMINISTRADOR','ROLE_OPERADOR','ROLE_CONSULTANTE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `movil` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imei` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL,
  `ultimo_logueo` datetime DEFAULT NULL,
  `ultimo_deslogueo` datetime DEFAULT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`username`,`password`,`role`,`movil`,`imei`,`is_active`,`activo`,`creado`,`actualizado`,`ultimo_logueo`,`ultimo_deslogueo`,`nombre_completo`,`avatar`) values (1,'admin','$2y$12$RBtP90dX0AFEbG/wMxoate.Ock2wzdsgsN8jtm4weAJz2ZYyfucai','ROLE_ADMINISTRADOR',NULL,NULL,1,1,'2019-09-09 00:00:00','2019-12-17 20:39:41','2019-12-17 20:39:41','2019-12-17 20:37:42','Administrador','avatar.jpg'),(2,'operador','$2y$12$.k6KYevmTZcVxXJnZtPfYuE2oAyOgiyOtxT8bn.nnXcOmUh66qV2C','ROLE_OPERADOR',NULL,NULL,1,0,'2019-09-29 03:15:34','2019-12-17 20:39:34','2019-12-17 20:37:49','2019-12-17 20:39:34','operador','avatar.jpg'),(3,'consultor','$2y$12$vMQuC7opHyLMbMjh9K4haOR08YdBbN81eyTawafPwOhL9miLN1Qp2','ROLE_CONSULTANTE',NULL,NULL,1,0,'2019-09-29 03:16:12','2019-11-19 20:20:15','2019-11-19 20:20:08','2019-11-19 20:20:15','Consultor','avatar.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;