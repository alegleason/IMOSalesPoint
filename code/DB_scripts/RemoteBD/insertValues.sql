INSERT INTO Categorias (idCategoria, nombre) VALUES
  (1, 'Comidas'),
  (2, 'Bebidas'),
  (3, 'Postres');


INSERT INTO Permisos (idPermiso, permiso) VALUES
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

INSERT INTO PermisosXRol (idRol, idPermiso) VALUES
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
  (3, 35),
  (3, 37),
  (3, 43),
  (3, 44),
  (3, 49),
  (3, 50),
  (3, 51),
  (3, 53);

INSERT INTO Productos (idProducto, idCategoria, precio, descripcion, nombre, fechaCaducidad, disponible) VALUES
  (2, 2, 10, 'Bebida ', 'Capuchino', NULL, 1),
  (3, 1, 15, 'Con tortilla de harina', 'Quesadillas', NULL, 0),
  (4, 2, 30, 'Bebida caliente', 'Expreso', NULL, 1),
  (5, 3, 15, 'Varios sabores', 'Gelatina', NULL, 1),
  (6, 3, 15, 'Postre de Marinela', 'Gansito', NULL, 1),
  (7, 2, 20, 'Bebida caliente', 'Moka', NULL, 1),
  (8, 2, 25, 'Bebida caliente', 'Chocolate', NULL, 0),
  (9, 2, 15, 'Bebida láctea', 'Leche', NULL, 1),
  (11, 2, 30, 'Bebida gaseosa', 'Coca', NULL, 0),
  (12, 1, 30, 'De jamón y queso', 'Torta', NULL, 0),
  (13, 1, 20, 'Con guiso y lechuga', 'Tostadas', NULL, 0),
  (14, 1, 20, 'Con jamón y queso', 'Cuernitos', NULL, 0),
  (15, 1, 20, 'Guisos varios', 'Tacos', NULL, 1),
  (16, 1, 25, 'Con frijoles y queso (2)', 'Molletes', NULL, 0),
  (17, 1, 20, 'Con frijoles y queso (2)', 'Sopes', NULL, 0),
  (18, 3, 10, 'De chocolate con chispas', 'Brownie', NULL, 1),
  (19, 3, 20, 'De tres leches', 'Pastel ', NULL, 1),
  (21, 2, 10, 'Bebida', 'Latte', NULL, 1),
  (23, 1, 40, 'De pollo con salsa verde (2)', 'Enchiladas', NULL, 0),
  (24, 2, 7, 'Bebida caliente a base de agua', 'Té', NULL, 1),
  (29, 1, 23, 'Súper fritas papas', 'Papas fritas', NULL, 0);

INSERT INTO Usuarios (idUsuario, idRol, nombre, apellidoPaterno, apellidoMaterno, telefono, correo, fechaNacimiento, contrasena, deuda) VALUES
  (1, 2, 'Salvador', 'Espinosa', 'Guerra', '4421091582', 'salvador.espinosa@imoiap.edu.mx', '2019-03-12', '$2y$10$JDmZNVzEgnJYnimWq2NwGODg9d5ZynODjMOVcYEQ.ovrlO2mHs79W', 0),
  (2, 1, 'Carlos', 'García', 'Herrera', '4421817718', 'carlos.garcia@imoiap.edu.mx', '2019-03-03', '$2y$10$WxKqfp60ouNdrC2XQ/N00uByjs2TqX/GPHvnqG0o/ODmhhqzKUVHS', 0),
  (3, 3, 'Guadalupe', 'Contreras', 'Hernández', '4421091589', 'gdlp.contreras@imoiap.edu.mx', '2019-03-01', '$2y$10$sKloQVFjdazESlDlH1yEOereegmtHDYcTT/4sNmt.tMhWNERYo2lO', 0),
  (4, 2, 'Alejandro', 'Gleason', 'Mendoza', '4424675795', 'sara.rodriguez98@gmail.com', '2019-03-03', '$2y$10$Q7lVK/QmxKHrjBoe8VBjEuU/YETDGnHFKLIdwBgzQ84b030MrveFq', 0),
  (5, 2, 'Sandra', 'Roman', 'Rivera', '4421091582', 'a01702863@itesm.mx', '1998-03-18', '$2y$10$J1x2zRxuR5VGAJpZAFOFY.jIazg7Y9izXhEjSaWIwry4vGyt9PiEi', 0);