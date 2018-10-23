USE lsystemsboxes;

CREATE TABLE Auditoria (
   id INT NOT NULL AUTO_INCREMENT,
   tabla VARCHAR(100) NULL,
   anterior LONGTEXT NULL,
   nuevo LONGTEXT NULL,
   comando LONGTEXT NULL,
   usuario VARCHAR(200) NULL,
   ip VARCHAR(20) NULL,
   fecha DATETIME NULL,
   PRIMARY KEY (id)
);

DELIMITER //
CREATE TRIGGER Actualizar_Caja
AFTER UPDATE ON Caja
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Caja',CONCAT("\"id\":",OLD.id,"\"codigo\":",OLD.codigo,"\"latitudUbicacion\":",OLD.latitudUbicacion,"\"longitudUbicacion\":",OLD.longitudUbicacion,"\"direccion\":",OLD.direccion,"\"ancho\":",OLD.ancho,"\"largo\":",OLD.largo,"\"profundidad\":",OLD.profundidad),CONCAT("\"id\":",NEW.id,"\"codigo\":",NEW.codigo,"\"latitudUbicacion\":",NEW.latitudUbicacion,"\"longitudUbicacion\":",NEW.longitudUbicacion,"\"direccion\":",NEW.direccion,"\"ancho\":",NEW.ancho,"\"largo\":",NEW.largo,"\"profundidad\":",NEW.profundidad),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Insertar_Caja
BEFORE INSERT ON Caja
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Caja',null,CONCAT("\"id\":",NEW.id,"\"codigo\":",NEW.codigo,"\"latitudUbicacion\":",NEW.latitudUbicacion,"\"longitudUbicacion\":",NEW.longitudUbicacion,"\"direccion\":",NEW.direccion,"\"ancho\":",NEW.ancho,"\"largo\":",NEW.largo,"\"profundidad\":",NEW.profundidad),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Borrar_Caja
AFTER DELETE ON Caja
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Caja',CONCAT("\"id\":",OLD.id,"\"codigo\":",OLD.codigo,"\"latitudUbicacion\":",OLD.latitudUbicacion,"\"longitudUbicacion\":",OLD.longitudUbicacion,"\"direccion\":",OLD.direccion,"\"ancho\":",OLD.ancho,"\"largo\":",OLD.largo,"\"profundidad\":",OLD.profundidad),null,@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Actualizar_Estado
AFTER UPDATE ON Estado
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Estado',CONCAT("\"id\":",OLD.id,"\"descripcion\":",OLD.descripcion),CONCAT("\"id\":",NEW.id,"\"descripcion\":",NEW.descripcion),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Insertar_Estado
BEFORE INSERT ON Estado
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Estado',null,CONCAT("\"id\":",NEW.id,"\"descripcion\":",NEW.descripcion),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Borrar_Estado
AFTER DELETE ON Estado
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Estado',CONCAT("\"id\":",OLD.id,"\"descripcion\":",OLD.descripcion),null,@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;


DELIMITER //
CREATE TRIGGER Actualizar_EstadoCaja
AFTER UPDATE ON EstadoCaja
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('EstadoCaja',CONCAT("\"id\":",OLD.id,"\"cantidad\":",OLD.cantidad,"\"idEstado\":",OLD.idEstado,"\"idCaja\":",OLD.idCaja,"\"fecha\":",OLD.fecha),CONCAT("\"id\":",NEW.id,"\"cantidad\":",NEW.cantidad,"\"idEstado\":",NEW.idEstado,"\"idCaja\":",NEW.idCaja,"\"fecha\":",NEW.fecha),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Insertar_EstadoCaja
BEFORE INSERT ON EstadoCaja
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('EstadoCaja',null,CONCAT("\"id\":",NEW.id,"\"cantidad\":",NEW.cantidad,"\"idEstado\":",NEW.idEstado,"\"idCaja\":",NEW.idCaja,"\"fecha\":",NEW.fecha),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Borrar_EstadoCaja
AFTER DELETE ON EstadoCaja
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('EstadoCaja',CONCAT("\"id\":",OLD.id,"\"cantidad\":",OLD.cantidad,"\"idEstado\":",OLD.idEstado,"\"idCaja\":",OLD.idCaja,"\"fecha\":",OLD.fecha),null,@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;


DELIMITER //
CREATE TRIGGER Actualizar_Reciclaje
AFTER UPDATE ON Reciclaje
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Reciclaje',CONCAT("\"id\":",OLD.id,"\"idCaja\":",OLD.idCaja,"\"cantidad\":",OLD.cantidad,"\"fecha\":",OLD.fecha,"\"idUsuario\":",OLD.idUsuario),CONCAT("\"id\":",NEW.id,"\"idCaja\":",NEW.idCaja,"\"cantidad\":",NEW.cantidad,"\"fecha\":",NEW.fecha,"\"idUsuario\":",NEW.idUsuario),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Insertar_Reciclaje
BEFORE INSERT ON Reciclaje
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Reciclaje',null,CONCAT("\"id\":",NEW.id,"\"idCaja\":",NEW.idCaja,"\"cantidad\":",NEW.cantidad,"\"fecha\":",NEW.fecha,"\"idUsuario\":",NEW.idUsuario),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Borrar_Reciclaje
AFTER DELETE ON Reciclaje
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Reciclaje',CONCAT("\"id\":",OLD.id,"\"idCaja\":",OLD.idCaja,"\"cantidad\":",OLD.cantidad,"\"fecha\":",OLD.fecha,"\"idUsuario\":",OLD.idUsuario),null,@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;


DELIMITER //
CREATE TRIGGER Actualizar_Rol
AFTER UPDATE ON Rol
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Rol',CONCAT("\"id\":",OLD.id,"\"descripcion\":",OLD.descripcion),CONCAT("\"id\":",NEW.id,"\"descripcion\":",NEW.descripcion),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Insertar_Rol
BEFORE INSERT ON Rol
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Rol',null,CONCAT("\"id\":",NEW.id,"\"descripcion\":",NEW.descripcion),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Borrar_Rol
AFTER DELETE ON Rol
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Rol',CONCAT("\"id\":",OLD.id,"\"descripcion\":",OLD.descripcion),null,@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;


DELIMITER //
CREATE TRIGGER Actualizar_Usuario
AFTER UPDATE ON Usuario
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Usuario',CONCAT("\"id\":",OLD.id,"\"identificacion\":",OLD.identificacion,"\"nombres\":",OLD.nombres,"\"apellidos\":",OLD.apellidos,"\"latitudDireccionDomicilio\":",OLD.latitudDireccionDomicilio,"\"longitudDireccionDomicilio\":",OLD.longitudDireccionDomicilio,"\"email\":",OLD.email,"\"telefono\":",OLD.telefono),CONCAT("\"id\":",NEW.id,"\"identificacion\":",NEW.identificacion,"\"nombres\":",NEW.nombres,"\"apellidos\":",NEW.apellidos,"\"latitudDireccionDomicilio\":",NEW.latitudDireccionDomicilio,"\"longitudDireccionDomicilio\":",NEW.longitudDireccionDomicilio,"\"email\":",NEW.email,"\"telefono\":",NEW.telefono),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Insertar_Usuario
BEFORE INSERT ON Usuario
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Usuario',null,CONCAT("\"id\":",NEW.id,"\"identificacion\":",NEW.identificacion,"\"nombres\":",NEW.nombres,"\"apellidos\":",NEW.apellidos,"\"latitudDireccionDomicilio\":",NEW.latitudDireccionDomicilio,"\"longitudDireccionDomicilio\":",NEW.longitudDireccionDomicilio,"\"email\":",NEW.email,"\"telefono\":",NEW.telefono),@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Borrar_Usuario
AFTER DELETE ON Usuario
FOR EACH ROW
BEGIN
   INSERT INTO Auditoria(tabla, anterior, nuevo, comando, usuario, ip, fecha) VALUES ('Usuario',CONCAT("\"id\":",OLD.id,"\"identificacion\":",OLD.identificacion,"\"nombres\":",OLD.nombres,"\"apellidos\":",OLD.apellidos,"\"latitudDireccionDomicilio\":",OLD.latitudDireccionDomicilio,"\"longitudDireccionDomicilio\":",OLD.longitudDireccionDomicilio,"\"email\":",OLD.email,"\"telefono\":",OLD.telefono),null,@comando,@usuario,@ip,NOW());
   SET @comando = null;
   SET @usuario = null;
   SET @ip = null;
END;
//
DELIMITER ;


