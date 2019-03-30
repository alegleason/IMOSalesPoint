-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2019 a las 23:47:47
-- Versión del servidor: 5.5.57-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Symphony`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto`(IN `categoria` INT, IN `precio` INT, IN `descripcion` VARCHAR(50), IN `nombre` VARCHAR(30))
INSERT INTO `Productos`(`idProducto`, `idCategoria`, `precio`, `descripcion`, `nombre`, `fechaCaducidad`, `disponible`) VALUES (NULL,categoria,precio,descripción,nombre,NULL,1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_disponibilidad`(IN `id` INT(4), IN `num` TINYINT(1))
UPDATE Productos 
SET disponible=num 
WHERE idProducto=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_productos`(IN `idcat` INT)
SELECT P.idProducto, P.nombre, P.disponible
FROM Productos P
WHERE P.idCategoria=idcat$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_productos_todos`()
SELECT *
FROM Productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_producto_id`(IN `id` INT)
SELECT *
FROM Productos P
WHERE P.idProducto=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_usuarios_todos`()
SELECT *
FROM Usuarios$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_usuario_id`(IN `id` INT)
SELECT *
FROM Usuarios
WHERE idUsuario=id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE IF NOT EXISTS `Categorias` (
  `idCategoria` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`idCategoria`, `nombre`) VALUES
(1, 'Comidas'),
(2, 'Bebidas'),
(3, 'Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Compras`
--

CREATE TABLE IF NOT EXISTS `Compras` (
  `idCompra` int(10) NOT NULL AUTO_INCREMENT,
  `idUsuarioComprador` int(4) NOT NULL,
  `idUsuarioVendedor` int(4) NOT NULL,
  `idPago` int(6) DEFAULT NULL,
  `horaVenta` time NOT NULL,
  `fechaVenta` date NOT NULL,
  `statusPagado` tinyint(1) NOT NULL,
  `horaEntrega` time DEFAULT NULL,
  PRIMARY KEY (`idCompra`),
  KEY `idUsuarioComprador` (`idUsuarioComprador`),
  KEY `idUsuarioVendedor` (`idUsuarioVendedor`),
  KEY `idPago` (`idPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MetodosPago`
--

CREATE TABLE IF NOT EXISTS `MetodosPago` (
  `idMetodoPago` int(4) NOT NULL AUTO_INCREMENT,
  `nombreMetodoPago` varchar(8) NOT NULL,
  PRIMARY KEY (`idMetodoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pagos`
--

CREATE TABLE IF NOT EXISTS `Pagos` (
  `idPago` int(6) NOT NULL AUTO_INCREMENT,
  `idMetodoPago` int(4) NOT NULL,
  `horaPago` time NOT NULL,
  `cantidadPago` float NOT NULL,
  `fechaPago` date NOT NULL,
  PRIMARY KEY (`idPago`),
  KEY `idMetodoPago` (`idMetodoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `idPermisos` int(3) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(15) NOT NULL,
  PRIMARY KEY (`idPermisos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Volcado de datos para la tabla `Permisos`
--

INSERT INTO `Permisos` (`idPermisos`, `permiso`) VALUES
(33, 'verSaldos'),
(34, 'verMiSaldo'),
(35, 'editarProductos'),
(36, 'verProductosDis'),
(37, 'verComprasPendi'),
(38, 'verMisCompras'),
(39, 'registrarCompra'),
(40, 'registrarPagoEn'),
(41, 'editarSaldos'),
(42, 'verPagos'),
(43, 'realizarCorte'),
(44, 'editarTicketCom'),
(45, 'generarReportes'),
(47, 'editarUsuarios'),
(48, 'editarMiUsuario'),
(49, 'verProductos'),
(50, 'registrarCompra'),
(51, 'registrarPagoEn'),
(53, 'editarMenu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PermisosXRol`
--

CREATE TABLE IF NOT EXISTS `PermisosXRol` (
  `idRol` int(5) NOT NULL,
  `idPermiso` int(3) NOT NULL,
  PRIMARY KEY (`idRol`,`idPermiso`),
  KEY `idRol` (`idRol`),
  KEY `idPermiso` (`idPermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PermisosXRol`
--

INSERT INTO `PermisosXRol` (`idRol`, `idPermiso`) VALUES
(1, 35),
(1, 41),
(1, 45),
(1, 47),
(2, 34),
(2, 36),
(2, 38),
(2, 39),
(2, 40),
(2, 44),
(2, 48),
(3, 33),
(3, 37),
(3, 43),
(3, 44),
(3, 49),
(3, 50),
(3, 51),
(3, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE IF NOT EXISTS `Productos` (
  `idProducto` int(4) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(4) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idCategoria` (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`idProducto`, `idCategoria`, `precio`, `descripcion`, `nombre`, `disponible`) VALUES
(1, 1, 25, 'Rojos o Verdes con queso', 'Chilaquiles', 1),
(2, 2, 20, 'Bebida caliente', 'Capuchino', 0),
(3, 1, 15, 'Con tortilla de harina', 'Quesadillas', 0),
(4, 2, 30, 'Bebida caliente', 'Expreso', 0),
(5, 3, 15, 'Varios sabores', 'Gelatina', 1),
(6, 3, 15, 'Postre de Marinela', 'Gansito', 1),
(7, 2, 20, 'Bebida caliente', 'Moka', 0),
(8, 2, 25, 'Bebida caliente', 'Chocolate', 0),
(9, 2, 15, 'Bebida láctea', 'Leche', 0),
(10, 2, 15, 'Bebida caliente a base de agua', 'Te', 0),
(11, 2, 30, 'Bebida gaseosa', 'Coca', 0),
(12, 1, 30, 'De jamón y queso', 'Torta', 0),
(13, 1, 20, 'Con guiso y lechuga', 'Tostadas', 0),
(14, 1, 20, 'Con jamón y queso', 'Cuernitos', 0),
(15, 1, 20, 'Guisos varios', 'Tacos', 1),
(16, 1, 25, 'Con frijoles y queso (2)', 'Molletes', 0),
(17, 1, 20, 'Con frijoles y queso (2)', 'Sopes', 0),
(18, 3, 10, 'De chocolate con chispas', 'Brownie', 1),
(19, 3, 20, 'De tres leches', 'Pastel ', 1),
(21, 2, 25, 'Bebida caliente', 'Latte', 0),
(23, 1, 40, 'De pollo con salsa verde (2)', 'Enchiladas', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProductosXCompra`
--

CREATE TABLE IF NOT EXISTS `ProductosXCompra` (
  `idCompra` int(10) NOT NULL,
  `idProducto` int(4) NOT NULL,
  `precioVenta` double NOT NULL,
  PRIMARY KEY (`idCompra`,`idProducto`),
  KEY `idProducto` (`idProducto`),
  KEY `idCompra` (`idCompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE IF NOT EXISTS `Roles` (
  `idRol` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`idRol`, `nombre`) VALUES
(1, 'admin'),
(2, 'comprador'),
(3, 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuario` int(4) NOT NULL AUTO_INCREMENT,
  `idRol` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(50) NOT NULL,
  `apellidoMaterno` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `contrasena` varchar(16) NOT NULL,
  `deuda` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`idUsuario`, `idRol`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `correo`, `fechaNacimiento`, `contrasena`, `deuda`) VALUES
(1, 1, 'Carlos', 'García', 'Herrera', '4421817718', 'carlos.garcia@imoiap.edu.mx', '2019-03-03', '12345', 100),
(2, 2, 'Salvador', 'Espinosa', 'Guerra', '4421091582', 'salvador.espinosa@imoiap.edu.mx', '2018-12-04', '1234', 0),
(3, 3, 'Guadalupe', 'Contreras', 'Hernández', '4421091589', 'gdlp.contreras@imoiap.edu.mx', '2018-10-22', '123', 50);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Compras`
--
ALTER TABLE `Compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`idUsuarioComprador`) REFERENCES `Usuarios` (`idUsuario`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`idUsuarioVendedor`) REFERENCES `Usuarios` (`idUsuario`),
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`idPago`) REFERENCES `Pagos` (`idPago`);

--
-- Filtros para la tabla `Pagos`
--
ALTER TABLE `Pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idMetodoPago`) REFERENCES `MetodosPago` (`idMetodoPago`);

--
-- Filtros para la tabla `PermisosXRol`
--
ALTER TABLE `PermisosXRol`
  ADD CONSTRAINT `permisosxrol_ibfk_1` FOREIGN KEY (`idPermiso`) REFERENCES `Permisos` (`idPermisos`),
  ADD CONSTRAINT `permisosxrol_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `Roles` (`idRol`);

--
-- Filtros para la tabla `ProductosXCompra`
--
ALTER TABLE `ProductosXCompra`
  ADD CONSTRAINT `productosxcompra_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `Productos` (`idProducto`),
  ADD CONSTRAINT `productosxcompra_ibfk_3` FOREIGN KEY (`idCompra`) REFERENCES `Compras` (`idCompra`);

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `Roles` (`idRol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
