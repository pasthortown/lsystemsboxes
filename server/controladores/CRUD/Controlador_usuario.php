<?php
include_once('../controladores/Controlador_Base.php');
include_once('../entidades/CRUD/Usuario.php');
class Controlador_usuario extends Controlador_Base
{
   function crear($args)
   {
      $usuario = new Usuario($args["id"],$args["identificacion"],$args["nombres"],$args["apellidos"],$args["latitudDireccionDomicilio"],$args["longitudDireccionDomicilio"],$args["email"],$args["telefono"]);
      $sql = "INSERT INTO Usuario (identificacion,nombres,apellidos,latitudDireccionDomicilio,longitudDireccionDomicilio,email,telefono) VALUES (?,?,?,?,?,?,?);";
      $parametros = array($usuario->identificacion,$usuario->nombres,$usuario->apellidos,$usuario->latitudDireccionDomicilio,$usuario->longitudDireccionDomicilio,$usuario->email,$usuario->telefono);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function actualizar($args)
   {
      $usuario = new Usuario($args["id"],$args["identificacion"],$args["nombres"],$args["apellidos"],$args["latitudDireccionDomicilio"],$args["longitudDireccionDomicilio"],$args["email"],$args["telefono"]);
      $parametros = array($usuario->identificacion,$usuario->nombres,$usuario->apellidos,$usuario->latitudDireccionDomicilio,$usuario->longitudDireccionDomicilio,$usuario->email,$usuario->telefono,$usuario->id);
      $sql = "UPDATE Usuario SET identificacion = ?,nombres = ?,apellidos = ?,latitudDireccionDomicilio = ?,longitudDireccionDomicilio = ?,email = ?,telefono = ? WHERE id = ?;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function borrar($args)
   {
      $id = $args["id"];
      $parametros = array($id);
      $sql = "DELETE FROM Usuario WHERE id = ?;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function leer($args)
   {
      $id = $args["id"];
      if ($id==""){
         $sql = "SELECT * FROM Usuario;";
      }else{
      $parametros = array($id);
         $sql = "SELECT * FROM Usuario WHERE id = ?;";
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function leer_paginado($args)
   {
      $pagina = $args["pagina"];
      $registrosPorPagina = $args["registros_por_pagina"];
      $desde = (($pagina-1)*$registrosPorPagina);
      $sql ="SELECT * FROM Usuario LIMIT $desde,$registrosPorPagina;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function numero_paginas($args)
   {
      $registrosPorPagina = $args["registros_por_pagina"];
      $sql ="SELECT IF(ceil(count(*)/$registrosPorPagina)>0,ceil(count(*)/$registrosPorPagina),1) as 'paginas' FROM Usuario;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta[0];
   }

   function leer_filtrado($args)
   {
      $nombreColumna = $args["columna"];
      $tipoFiltro = $args["tipo_filtro"];
      $filtro = $args["filtro"];
      switch ($tipoFiltro){
         case "coincide":
            $parametros = array($filtro);
            $sql = "SELECT * FROM Usuario WHERE $nombreColumna = ?;";
            break;
         case "inicia":
            $sql = "SELECT * FROM Usuario WHERE $nombreColumna LIKE '$filtro%';";
            break;
         case "termina":
            $sql = "SELECT * FROM Usuario WHERE $nombreColumna LIKE '%$filtro';";
            break;
         default:
            $sql = "SELECT * FROM Usuario WHERE $nombreColumna LIKE '%$filtro%';";
            break;
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }
}