
INSERT INTO `Permisos` (`idPermisos`, `permiso`) VALUES
(33, 'verSaldos'),
(34, 'verMiSaldo'),
(35, 'editarProductos'),
(36, 'verProductosDisponibles'),
(37, 'verComprasPendientes'),
(38, 'verMisCompras'),
(39, 'registrarCompraEnLinea'),
(40, 'registrarPagoEnLinea'),
(41, 'editarSaldos'),
(42, 'verPagos'),
(43, 'realizarCorte'),
(44, 'editarTicketCompra'),
(45, 'generarReportes'),
(47, 'editarUsuarios'),
(48, 'editarMiUsuario'),
(49, 'verProductos'),
(50, 'registrarCompraEnPV'),
(51, 'registrarPagoEnPV'),
(53, 'editarMenu');



INSERT INTO `Roles` (`idRol`, `nombre`) VALUES
(1, 'admin'),
(2, 'comprador'),
(3, 'vendedor');


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


INSERT INTO `Usuarios` (`idUsuario`, `idRol`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `correo`, `fechaNacimiento`, `contrasena`, `deuda`) VALUES
(NULL, 2, 'Alejandro', 'Gleason', 'Mendoza', '4424675795', 'sara.rodriguez98@gmail.com', '2019-03-03', '$2y$10$Q7lVK/QmxKHrjBoe8VBjEuU/YETDGnHFKLIdwBgzQ84b030MrveFq', 0),
(NULL, 2, 'Salvador', 'Espinosa', 'Guerra', '4421091582', 'salvador.espinosa@imoiap.edu.mx', '2019-03-12', '$2y$10$JDmZNVzEgnJYnimWq2NwGODg9d5ZynODjMOVcYEQ.ovrlO2mHs79W', 0),
(NULL, 1, 'Carlos', 'García', 'Herrera', '4421817718', 'carlos.garcia@imoiap.edu.mx', '2019-03-03', '$2y$10$WxKqfp60ouNdrC2XQ/N00uByjs2TqX/GPHvnqG0o/ODmhhqzKUVHS', 0),
(NULL, 3, 'Guadalupe', 'Contreras', 'Hernández', '4421091589', 'gdlp.contreras@imoiap.edu.mx', '2019-03-01', '$2y$10$sKloQVFjdazESlDlH1yEOereegmtHDYcTT/4sNmt.tMhWNERYo2lO', 0);


INSERT INTO `Categorias` (`idCategoria`, `nombre`) VALUES
(1, 'Comidas'),
(2, 'Bebidas'),
(3, 'Postres');

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

