USE lsystemsboxes;

ALTER TABLE Caja ADD UNIQUE unique_index_caja (codigo);
ALTER TABLE EstadoCaja ADD UNIQUE unique_index_estado_caja (idCaja,fecha,idEstado);
ALTER TABLE Estado ADD UNIQUE unique_index_estado (descripcion);
ALTER TABLE Reciclaje ADD UNIQUE unique_index_reciclaje (idCaja,fecha,idUsuario,cantidad);
ALTER TABLE Rol ADD UNIQUE unique_index_rol (descripcion);
ALTER TABLE Usuario ADD UNIQUE unique_index_usuario (email);
ALTER TABLE Cuenta ADD UNIQUE unique_index_cuenta (idUsuario, idRol, nickname);
ALTER TABLE AvatarUsuario ADD UNIQUE unique_index_avatar_usuario (idUsuario);