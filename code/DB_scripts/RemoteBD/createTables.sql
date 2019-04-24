SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-06:00";

-- TABLA CATEGORÍAS
CREATE TABLE Categorias (
  idCategoria int(4) NOT NULL AUTO_INCREMENT,
  nombre varchar(30) NOT NULL,

  PRIMARY KEY (idCategoria)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- TABLA COMPRAS
CREATE TABLE Compras (
  idCompra int(10) NOT NULL AUTO_INCREMENT,
  idUsuarioComprador int(4) NOT NULL,
  idUsuarioVendedor int(4) NOT NULL,
  horaFechaVenta timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  horaEntrega time DEFAULT NULL,

  PRIMARY KEY (idCompra),

  CONSTRAINT fkComprasComprador FOREIGN KEY (idUsuarioComprador) REFERENCES Usuarios (idUsuario),
  CONSTRAINT fkComprasVendedor FOREIGN KEY (idUsuarioVendedor) REFERENCES Usuarios (idUsuario)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- TABLA METODOSPAGO
CREATE TABLE MetodosPago (
  idMetodoPago int(4) NOT NULL AUTO_INCREMENT,
  nombreMetodoPago varchar(8) NOT NULL,

  PRIMARY KEY (idMetodoPago)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO MetodosPago (idMetodoPago, nombreMetodoPago) VALUES
  (1, 'efectivo'),
  (2, 'tarjeta'),
  (3, 'fiado');


-- TABLA PAGOS
CREATE TABLE Pagos (
  idPago int(6) NOT NULL AUTO_INCREMENT,
  idMetodoPago int(4) NOT NULL,
  idUsuario int(4) NOT NULL,
  cantidadPago float NOT NULL,
  horaFechaPago timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (idPago),

  CONSTRAINT fkPagosMetodo FOREIGN KEY (idMetodoPago) REFERENCES MetodosPago (idMetodoPago),
  CONSTRAINT fkPagosUsuario FOREIGN KEY (idUsuario) REFERENCES Usuarios (idUsuario)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- TABLA PERMISOS
CREATE TABLE Permisos (
  idPermiso int(3) NOT NULL AUTO_INCREMENT,
  permiso varchar(30) NOT NULL,

  PRIMARY KEY (idPermiso)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- TABLA PERMISOSXROL
CREATE TABLE PermisosXRol (
  idRol int(5) NOT NULL,
  idPermiso int(3) NOT NULL,

  PRIMARY KEY (idRol, idPermiso),

  CONSTRAINT fkPermisosXRolPermiso FOREIGN KEY (idPermiso) REFERENCES Permisos (idPermiso),
  CONSTRAINT fkPermisosXRolRol FOREIGN KEY (idRol) REFERENCES Roles (idRol)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- TABLA PRODUCTOS
CREATE TABLE Productos (
  idProducto int(4) NOT NULL AUTO_INCREMENT,
  idCategoria int(4) NOT NULL,
  precio float NOT NULL,
  descripcion varchar(100) NOT NULL,
  nombre varchar(30) NOT NULL,
  disponible tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL DEFAULT '1',

  PRIMARY KEY (idProducto),
  UNIQUE KEY nombre (nombre),

  CONSTRAINT fkProductosCategoria FOREIGN KEY (idCategoria) REFERENCES Categorias (idCategoria)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- TABLA PRODUCTOSXCOMPRA
CREATE TABLE ProductosXCompra (
  idCompra int(10) NOT NULL,
  idProducto int(4) NOT NULL,
  cantidad int(3) NOT NULL DEFAULT '1',
  precioVenta double NOT NULL,

  PRIMARY KEY (idCompra,idProducto),

  CONSTRAINT fkProductosXCompraProducto FOREIGN KEY (idProducto) REFERENCES Productos (idProducto),
  CONSTRAINT fkProductosXCompraCompra FOREIGN KEY (idCompra) REFERENCES Compras (idCompra)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- TABLA ROLES
CREATE TABLE Roles (
  idRol int(5) NOT NULL AUTO_INCREMENT,
  nombre varchar(15) NOT NULL,

  PRIMARY KEY (idRol)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO Roles (idRol, nombre) VALUES
  (1, 'admin'),
  (2, 'comprador'),
  (3, 'vendedor');


-- TABLA USUARIOS
CREATE TABLE Usuarios (
  idUsuario int(4) NOT NULL AUTO_INCREMENT,
  idRol int(5) NOT NULL DEFAULT '2',
  nombre varchar(50) NOT NULL,
  apellidoPaterno varchar(50) NOT NULL,
  apellidoMaterno varchar(50) DEFAULT NULL,
  telefono varchar(10) NOT NULL,
  correo varchar(50) NOT NULL,
  fechaNacimiento date DEFAULT NULL,
  contrasena varchar(255) NOT NULL,
  deuda int(4) NOT NULL DEFAULT '0',
  activo tinyint(1) NOT NULL DEFAULT '1',

  PRIMARY KEY (idUsuario),

  CONSTRAINT fkUsuariosRol FOREIGN KEY (idRol) REFERENCES Roles (idRol)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;
