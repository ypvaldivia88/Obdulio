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

insert  into `planificaciondeleche`(`id`,`fk_termo`,`enero`,`febrero`,`marzo`,`abril`,`mayo`,`junio`,`julio`,`agosto`,`septiembre`,`octubre`,`noviembre`,`diciembre`,`anno`) values (1,2,345,40,345,345,345,345,345,345,345,345,345,345,345);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

insert  into `produccionleche`(`id`,`fk_termo`,`fecha`,`valor`,`factura`) values (1,2,'2018-03-04',546456,'546dsf');

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

/*Table structure for table `siembra` */

DROP TABLE IF EXISTS `siembra`;

CREATE TABLE `siembra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_producto` int(11) DEFAULT NULL,
  `fk_unidad` int(11) DEFAULT NULL,
  `enero` double DEFAULT NULL,
  `febrero` double DEFAULT NULL,
  `marzo` double DEFAULT NULL,
  `abril` double DEFAULT NULL,
  `mayo` double DEFAULT NULL,
  `junio` double DEFAULT NULL,
  `julio` double DEFAULT NULL,
  `agosto` double DEFAULT NULL,
  `septiembre` double DEFAULT NULL,
  `octubre` double DEFAULT NULL,
  `noviembre` double DEFAULT NULL,
  `diciembre` double DEFAULT NULL,
  `anno` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9B66C94DC6E493B0` (`anno`),
  KEY `IDX_9B66C94D959345CB` (`fk_producto`),
  KEY `IDX_9B66C94DD348B8BF` (`fk_unidad`),
  CONSTRAINT `FK_9B66C94D959345CB` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `FK_9B66C94DD348B8BF` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `siembra` */

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

insert  into `usuarios`(`id`,`username`,`password`,`role`,`movil`,`imei`,`is_active`,`activo`,`creado`,`actualizado`,`ultimo_logueo`,`ultimo_deslogueo`,`nombre_completo`,`avatar`) values (1,'admin','$2y$12$RBtP90dX0AFEbG/wMxoate.Ock2wzdsgsN8jtm4weAJz2ZYyfucai','ROLE_ADMINISTRADOR',NULL,NULL,1,1,'2019-09-09 00:00:00','2020-01-31 17:25:39','2020-01-31 17:25:39','2020-01-31 17:17:59','Administrador','avatar.jpg'),(2,'operador','$2y$12$.k6KYevmTZcVxXJnZtPfYuE2oAyOgiyOtxT8bn.nnXcOmUh66qV2C','ROLE_OPERADOR',NULL,NULL,1,0,'2019-09-29 03:15:34','2020-01-31 17:25:33','2020-01-31 17:20:38','2020-01-31 17:25:33','operador','avatar.jpg'),(3,'consultor','$2y$12$vMQuC7opHyLMbMjh9K4haOR08YdBbN81eyTawafPwOhL9miLN1Qp2','ROLE_CONSULTANTE',NULL,NULL,1,0,'2019-09-29 03:16:12','2019-11-19 20:20:15','2019-11-19 20:20:08','2019-11-19 20:20:15','Consultor','avatar.jpg');

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_producto` int(11) DEFAULT NULL,
  `fk_unidad` int(11) DEFAULT NULL,
  `enero` double DEFAULT NULL,
  `febrero` double DEFAULT NULL,
  `marzo` double DEFAULT NULL,
  `abril` double DEFAULT NULL,
  `mayo` double DEFAULT NULL,
  `junio` double DEFAULT NULL,
  `julio` double DEFAULT NULL,
  `agosto` double DEFAULT NULL,
  `septiembre` double DEFAULT NULL,
  `octubre` double DEFAULT NULL,
  `noviembre` double DEFAULT NULL,
  `diciembre` double DEFAULT NULL,
  `anno` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8FE7EE55959345CB` (`fk_producto`),
  KEY `IDX_8FE7EE55D348B8BF` (`fk_unidad`),
  CONSTRAINT `FK_8FE7EE55959345CB` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`id`),
  CONSTRAINT `FK_8FE7EE55D348B8BF` FOREIGN KEY (`fk_unidad`) REFERENCES `unidad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `venta` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
