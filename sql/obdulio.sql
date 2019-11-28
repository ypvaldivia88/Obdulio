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

insert  into `planificacionproduccion`(`id`,`fk_producto`,`fk_unidad`,`enero`,`febrero`,`marzo`,`abril`,`mayo`,`junio`,`julio`,`agosto`,`septiembre`,`octubre`,`noviembre`,`diciembre`,`anno`) values (1,1,1,3,2,2,2,2,2,2,2,2,2,2,2,1);

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

insert  into `produccion`(`id`,`fk_producto`,`fk_destino`,`fk_unidad`,`fecha`,`valor`,`factura`) values (1,1,2,1,'2020-01-01',3455,'34534'),(2,2,2,2,'2018-02-04',546456,'dsfsdf');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tipoproducto` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A7BB06153A909126` (`nombre`),
  KEY `IDX_A7BB0615E1D7C4D1` (`fk_tipoproducto`),
  CONSTRAINT `FK_A7BB0615E1D7C4D1` FOREIGN KEY (`fk_tipoproducto`) REFERENCES `tipoproducto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `producto` */

insert  into `producto`(`id`,`fk_tipoproducto`,`nombre`) values (1,2,'producto 0'),(2,1,'producto 1');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3E6D02F3A909126` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `unidad` */

insert  into `unidad`(`id`,`nombre`) values (1,'Unidad1'),(2,'unidad2');

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

insert  into `usuarios`(`id`,`username`,`password`,`role`,`movil`,`imei`,`is_active`,`activo`,`creado`,`actualizado`,`ultimo_logueo`,`ultimo_deslogueo`,`nombre_completo`,`avatar`) values (1,'admin','$2y$12$RBtP90dX0AFEbG/wMxoate.Ock2wzdsgsN8jtm4weAJz2ZYyfucai','ROLE_ADMINISTRADOR',NULL,NULL,1,1,'2019-09-09 00:00:00','2019-11-28 19:42:16','2019-11-28 19:42:16','2019-11-28 19:38:29','Administrador','avatar.jpg'),(2,'operador','$2y$12$.k6KYevmTZcVxXJnZtPfYuE2oAyOgiyOtxT8bn.nnXcOmUh66qV2C','ROLE_OPERADOR',NULL,NULL,1,0,'2019-09-29 03:15:34','2019-11-28 19:42:10','2019-11-28 19:38:37','2019-11-28 19:42:10','operador','avatar.jpg'),(3,'consultor','$2y$12$vMQuC7opHyLMbMjh9K4haOR08YdBbN81eyTawafPwOhL9miLN1Qp2','ROLE_CONSULTANTE',NULL,NULL,1,0,'2019-09-29 03:16:12','2019-11-19 20:20:15','2019-11-19 20:20:08','2019-11-19 20:20:15','Consultor','avatar.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
