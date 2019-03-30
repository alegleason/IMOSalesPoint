--Crear tablas
IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Roles')
drop table Roles
CREATE TABLE Roles
(
  idRol numeric(5) IDENTITY(0,1) not null,
  nombre varchar(15) not null

  constraint llaveRoles PRIMARY KEY (idRol)
)
/*
PK  IdRol
	FK  No tiene
	AK  IdRol, Nombre
 */

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Permisos')
drop table Permisos
CREATE TABLE Permisos
(
  idPermiso numeric(3) IDENTITY(0,1) not null,
<<<<<<< HEAD
  permisos varchar(30) not null
=======
  permisos varchar(15) not null

  constraint llavePermisos PRIMARY KEY (idPermiso)
>>>>>>> 7aba7f222e28ff13f57a75f93da9721b0e9afaef
)
/*
	PK  IdPermiso
	FK  No tiene
	AK  IdPermiso, Permisos
 */

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'MetodosPago')
drop table MetodosPago
CREATE TABLE MetodosPago
(
  idMetodoPago numeric(4) IDENTITY(0,1) not null,
  nombreMetodoPago varchar(8) not null

  constraint llaveMetodosPago PRIMARY KEY (idMetodoPago)
)
/*
	PK  IdMetodoPago
	FK  No tiene
	AK  IdMetodoPago, NombreMetodoPago
 */

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Categorias')
drop table Categorias
CREATE TABLE Categorias
(
  idCategoria numeric(4) IDENTITY(0,1) not null,
  nombre varchar(30) not null

  constraint llaveCategorias PRIMARY KEY (idCategoria)
)
/*
	PK  IdCategoria
	FK  No tiene
	AK  IdCategoria, NombreCategoria
 */

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Usuarios')
drop table Usuarios
CREATE TABLE Usuarios
(
  idUsuario numeric(4) IDENTITY(0,1) not null,
  idRol numeric(5) not null,
  nombre varchar(20) not null,
  apellidoPaterno varchar(20) not null,
  apellidoMaterno varchar(20),
  telefono numeric(10) not null,
  correo varchar(40) not null,
  fechaNacimiento DATE,
  contrasena varchar(16) not null

  constraint llaveUsuarios PRIMARY KEY (idUsuario)
  constraint fkUsuarios foreign key (idRol) references Roles(idRol)
)
/*
	PK  IdUsuario
	FK  IdRol
	AK  IdUsuario, IdRol
*/

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'PermisosXRol')
drop table PermisosXRol
CREATE TABLE PermisosXRol
(
  idRol numeric(5) not null,
  idPermiso numeric(3) not null

  constraint llavePermisosXRol PRIMARY KEY (idRol,idPermiso)
  constraint fkPermisosXRolRol foreign key (idRol) references Roles(idRol)
  constraint fkPermisosXRolPermiso foreign key (idPermiso) references Permisos(idPermiso)
)
/*
PK  IdRol, IdPermiso
	〖FK〗_1  IdRol
	〖FK〗_2  IdPermiso
	AK  No tiene
 */

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Pagos')
drop table Pagos
CREATE TABLE Pagos
(
  idPago numeric(6) IDENTITY(0,1) not null,
  idMetodoPago numeric(4) not null,
  horaPago TIME not null,
  cantidadPago money not null,
  fechaPago DATE not null

  constraint llavePagos PRIMARY KEY (idPago)
  constraint fkPagos foreign key (idMetodoPago) references MetodosPago(idMetodoPago)
  constraint cantidadPago check (cantidadPago >= 0)
)
/*
	PK  IdPago
	FK  IdMétodoPago
	AK  IdPago, IdMetodoPago, FechaPagado, HoraPago
 */

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Productos')
drop table Productos
CREATE TABLE Productos
(
  idProducto numeric(4) IDENTITY(0,1) not null,
  idCategoria numeric(4) not null,
  precio money not null,
  descripcion varchar(100) not null,
  nombre varchar(30) not null,
  fechaCaducidad DATE,
  disponible numeric(1) not null

  constraint llaveProductos PRIMARY KEY (idProducto)
  constraint fkProductos foreign key (idCategoria) references Categorias(idCategoria)
  constraint precio check (precio > 0)
)
/*
	PK  IdProducto
	FK  IdCategoria
	AK  IdProducto, IdCategoria, NombreProducto
 */

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Compras')
drop table Compras
CREATE TABLE Compras
(
  idCompra numeric(10) IDENTITY(0,1) not null,
  idUsuarioComprador numeric(4) not null,
<<<<<<< HEAD
  idUsuarioVendedor numeric(4),
  idPago numeric(6) not null,
=======
  idUsuarioVendedor numeric(4) not null,
  idPago numeric(6)p1,
>>>>>>> 7aba7f222e28ff13f57a75f93da9721b0e9afaef
  horaVenta TIME not null,
  fechaVenta DATE not null,
  statusPagado numeric(1) not null,
  horaEntrega TIME

  constraint llaveCompras PRIMARY KEY (idCompra)
  constraint fkComprasComprador foreign key (idUsuarioComprador) references Usuarios(idUsuario)
  constraint fkComprasVendedor foreign key (idUsuarioVendedor) references Usuarios(idUsuario)
  constraint fkComprasPago foreign key (idPago) references Pagos(idPago)
)
/*
	PK  IdCompra
	〖FK〗_1  IdUsuarioRolComprador
	〖FK〗_2  IdUsuarioRolVendedor
	〖FK〗_3  IdPago
	AK  IdCompra, IdUsuarioRolComprador, IdUsuarioRolVendedor, FechaVenta
*/

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'ProductosXCompra')
drop table ProductosXCompra
CREATE TABLE ProductosXCompra
(
  idCompra numeric(10) not null,
  idProducto numeric(4) not null,
<<<<<<< HEAD
  precioVenta money not null,
  cantidad numeric(2) not null
=======
  precioVenta money not null

  constraint llaveProductosXCompra PRIMARY KEY (idCompra,idProducto)
  constraint fkProductosXCompraCompra foreign key (idCompra) references Compras(idCompra)
  constraint fkProductosXCompraProducto foreign key (idProducto) references Productos(idProducto)
  constraint precioVenta check (precioVenta > 0)
>>>>>>> 7aba7f222e28ff13f57a75f93da9721b0e9afaef
)
/*
	PK  IdCompra, IdProducto
	〖FK〗_1  IdCompra
	〖FK〗_2  IdProducto
	AK  IdCompra, IdProducto, PrecioVenta
	*/
