DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_producto`(IN `id` INT)
DELETE FROM Productos Where idProducto=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto`(IN `categoria` INT, IN `precio` INT, IN `descripcion` VARCHAR(50), IN `nombre` VARCHAR(30))
INSERT INTO `Productos`(`idProducto`, `idCategoria`, `precio`, `descripcion`, `nombre`, `disponible`) VALUES (NULL,categoria,precio,descripción,nombre,1)$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_producto`(IN `id` INT, IN `des` VARCHAR(100), IN `price` INT, IN `cate` INT)
UPDATE Productos SET idCategoria=cate, descripcion=des, precio=price WHERE idProducto=id$$

DELIMITER ;