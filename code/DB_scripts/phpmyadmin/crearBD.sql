-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 21, 2019 at 11:10 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `Symphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categorias`
--

CREATE TABLE `Categorias` (
  `idCategoria` int(4) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Compras`
--

CREATE TABLE `Compras` (
  `idCompra` int(10) NOT NULL,
  `idUsuarioComprador` int(4) NOT NULL,
  `idUsuarioVendedor` int(4) NOT NULL,
  `idPago` int(6) DEFAULT NULL,
  `horaVenta` time NOT NULL,
  `fechaVenta` date NOT NULL,
  `statusPagado` tinyint(1) NOT NULL,
  `horaEntrega` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `MetodosPago`
--

CREATE TABLE `MetodosPago` (
  `idMetodoPago` int(4) NOT NULL,
  `nombreMetodoPago` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Pagos`
--

CREATE TABLE `Pagos` (
  `idPago` int(6) NOT NULL,
  `idMetodoPago` int(4) NOT NULL,
  `horaPago` time NOT NULL,
  `cantidadPago` float NOT NULL,
  `fechaPago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Permisos`
--

CREATE TABLE `Permisos` (
  `idPermisos` int(3) NOT NULL,
  `permiso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PermisosXRol`
--

CREATE TABLE `PermisosXRol` (
  `idRol` int(5) NOT NULL,
  `idPermiso` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `idProducto` int(4) NOT NULL,
  `idCategoria` int(4) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ProductosXCompra`
--

CREATE TABLE `ProductosXCompra` (
  `idCompra` int(10) NOT NULL,
  `idProducto` int(4) NOT NULL,
  `precioVenta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `idRol` int(5) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE `Usuarios` (
  `idUsuario` int(4) NOT NULL,
  `idRol` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(50) NOT NULL,
  `apellidoMaterno` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `deuda` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `Compras`
--
ALTER TABLE `Compras`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `idUsuarioComprador` (`idUsuarioComprador`),
  ADD KEY `idUsuarioVendedor` (`idUsuarioVendedor`),
  ADD KEY `idPago` (`idPago`);

--
-- Indexes for table `MetodosPago`
--
ALTER TABLE `MetodosPago`
  ADD PRIMARY KEY (`idMetodoPago`);

--
-- Indexes for table `Pagos`
--
ALTER TABLE `Pagos`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `idMetodoPago` (`idMetodoPago`);

--
-- Indexes for table `Permisos`
--
ALTER TABLE `Permisos`
  ADD PRIMARY KEY (`idPermisos`);

--
-- Indexes for table `PermisosXRol`
--
ALTER TABLE `PermisosXRol`
  ADD PRIMARY KEY (`idRol`,`idPermiso`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idPermiso` (`idPermiso`);

--
-- Indexes for table `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indexes for table `ProductosXCompra`
--
ALTER TABLE `ProductosXCompra`
  ADD PRIMARY KEY (`idCompra`,`idProducto`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idCompra` (`idCompra`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indexes for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `idCategoria` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compras`
--
ALTER TABLE `Compras`
  MODIFY `idCompra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `MetodosPago`
--
ALTER TABLE `MetodosPago`
  MODIFY `idMetodoPago` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pagos`
--
ALTER TABLE `Pagos`
  MODIFY `idPago` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Permisos`
--
ALTER TABLE `Permisos`
  MODIFY `idPermisos` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Productos`
--
ALTER TABLE `Productos`
  MODIFY `idProducto` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `idRol` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Compras`
--
ALTER TABLE `Compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`idUsuarioComprador`) REFERENCES `Usuarios` (`idUsuario`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`idUsuarioVendedor`) REFERENCES `Usuarios` (`idUsuario`),
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`idPago`) REFERENCES `Pagos` (`idPago`);

--
-- Constraints for table `Pagos`
--
ALTER TABLE `Pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idMetodoPago`) REFERENCES `MetodosPago` (`idMetodoPago`);

--
-- Constraints for table `PermisosXRol`
--
ALTER TABLE `PermisosXRol`
  ADD CONSTRAINT `permisosxrol_ibfk_1` FOREIGN KEY (`idPermiso`) REFERENCES `Permisos` (`idPermisos`),
  ADD CONSTRAINT `permisosxrol_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `Roles` (`idRol`);

--
-- Constraints for table `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `Categorias` (`idCategoria`);

--
-- Constraints for table `ProductosXCompra`
--
ALTER TABLE `ProductosXCompra`
  ADD CONSTRAINT `productosxcompra_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `Productos` (`idProducto`),
  ADD CONSTRAINT `productosxcompra_ibfk_3` FOREIGN KEY (`idCompra`) REFERENCES `Compras` (`idCompra`);

--
-- Constraints for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `Roles` (`idRol`);
