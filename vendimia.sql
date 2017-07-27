-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.45 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para vendimia
CREATE DATABASE IF NOT EXISTS `vendimia` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `vendimia`;


-- Volcando estructura para tabla vendimia.articulos
CREATE TABLE IF NOT EXISTS `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` char(50) DEFAULT NULL,
  `descripcion` char(50) DEFAULT NULL,
  `modelo` char(50) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clave` (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla vendimia.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` char(5) DEFAULT NULL,
  `nombre` char(255) DEFAULT NULL,
  `ape_pat` char(100) DEFAULT NULL,
  `ape_mat` char(100) DEFAULT NULL,
  `rfc` char(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clave` (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla vendimia.configuracion_general
CREATE TABLE IF NOT EXISTS `configuracion_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tasa_financiamiento` double(15,2) DEFAULT NULL,
  `porce_enganche` int(11) DEFAULT NULL,
  `plazo_maximo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla vendimia.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` char(10) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `total` double(16,2) DEFAULT NULL,
  `enganche` double(16,2) DEFAULT NULL,
  `bonificacion_enganche` double(16,2) DEFAULT NULL,
  `fecha_venta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `folio` (`folio`),
  KEY `FK_ventas_clientes` (`idcliente`),
  CONSTRAINT `FK_ventas_clientes` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla vendimia.ventas_detalle
CREATE TABLE IF NOT EXISTS `ventas_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` double(16,2) DEFAULT NULL,
  `importe` double(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detalles_ventas` (`idventa`),
  KEY `FK_detalles_articulos` (`idarticulo`),
  CONSTRAINT `FK_detalles_articulos` FOREIGN KEY (`idarticulo`) REFERENCES `articulos` (`id`),
  CONSTRAINT `FK_detalles_ventas` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla vendimia.ventas_plazo
CREATE TABLE IF NOT EXISTS `ventas_plazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `plazo_meses` int(11) DEFAULT NULL,
  `cantidad_abono` double(16,2) DEFAULT NULL,
  `total_a_pagar` double(16,2) DEFAULT NULL,
  `ahorro` double(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_plazo_ventas` (`idventa`),
  CONSTRAINT `FK_plazo_ventas` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
