CREATE DATABASE lsystemsboxes DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE lsystemsboxes;

CREATE TABLE Caja (
   id INT NOT NULL AUTO_INCREMENT,
   codigo VARCHAR(25) NULL,
   latitudUbicacion FLOAT NULL,
   longitudUbicacion FLOAT NULL,
   direccion VARCHAR(255) NULL,
   ancho FLOAT NULL,
   largo FLOAT NULL,
   profundidad FLOAT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE EstadoCaja (
   id INT NOT NULL AUTO_INCREMENT,
   cantidad INT NULL,
   idEstado INT NULL,
   idCaja INT NULL,
   fecha DATETIME NULL,
   PRIMARY KEY (id)
);

CREATE TABLE Estado (
   id INT NOT NULL AUTO_INCREMENT,
   descripcion VARCHAR(255) NULL,
   PRIMARY KEY (id)
);

CREATE TABLE Reciclaje (
	id INT NOT NULL AUTO_INCREMENT,
    idCaja INT NULL,
    cantidad INT NULL,
    fecha DATETIME NULL,
    idUsuario INT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Rol (
   id INT NOT NULL AUTO_INCREMENT,
   descripcion VARCHAR(255) NULL,
   PRIMARY KEY (id)
);

CREATE TABLE Usuario (
    id INT NOT NULL AUTO_INCREMENT,
    identificacion VARCHAR(20) NULL,
    nombres VARCHAR(255) NULL,
    apellidos VARCHAR(255) NULL,
    latitudDireccionDomicilio FLOAT NULL,
    longitudDireccionDomicilio FLOAT NULL,
    email VARCHAR(255) NULL,
    telefono VARCHAR(20) NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Cuenta (
    id INT NOT NULL AUTO_INCREMENT,
    idUsuario VARCHAR(255) NULL,
    idRol INT NULL,
    nickname VARCHAR(50) NULL,
    clave BLOB NULL,
    PRIMARY KEY (id)
);

CREATE TABLE AvatarUsuario (
    id INT NOT NULL AUTO_INCREMENT,
    idUsuario INT NULL,
    tipoArchivo VARCHAR(255) NULL,
    nombreArchivo VARCHAR(255) NULL,
    adjunto LONGBLOB NULL,
    PRIMARY KEY (id)
) ENGINE myISAM;
