<?php
include_once('../controladores/Controlador_Base.php');
include_once('../entidades/CRUD/Reciclaje.php');
class Controlador_reciclaje extends Controlador_Base
{
   function crear($args)
   {
      $reciclaje = new Reciclaje($args["id"],$args["idCaja"],$args["cantidad"],$args["fecha"],$args["idUsuario"]);
      $sql = "INSERT INTO Reciclaje (idCaja,cantidad,fecha,idUsuario) VALUES (?,?,?,?);";
      $fechaNoSQLTime = strtotime($reciclaje->fecha);
      $fechaSQLTime = date("Y-m-d H:i:s", $fechaNoSQLTime);
      $reciclaje->fecha = $fechaSQLTime;
      $parametros = array($reciclaje->idCaja,$reciclaje->cantidad,$reciclaje->fecha,$reciclaje->idUsuario);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function actualizar($args)
   {
      $reciclaje = new Reciclaje($args["id"],$args["idCaja"],$args["cantidad"],$args["fecha"],$args["idUsuario"]);
      $sql = "UPDATE Reciclaje SET idCaja = ?,cantidad = ?,fecha = ?,idUsuario = ? WHERE id = ?;";
      $fechaNoSQLTime = strtotime($reciclaje->fecha);
      $fechaSQLTime = date("Y-m-d H:i:s", $fechaNoSQLTime);
      $reciclaje->fecha = $fechaSQLTime;
      $parametros = array($reciclaje->idCaja,$reciclaje->cantidad,$reciclaje->fecha,$reciclaje->idUsuario,$reciclaje->id);
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
      $sql = "DELETE FROM Reciclaje WHERE id = ?;";
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
         $sql = "SELECT * FROM Reciclaje;";
      }else{
      $parametros = array($id);
         $sql = "SELECT * FROM Reciclaje WHERE id = ?;";
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function leer_paginado($args)
   {
      $pagina = $args["pagina"];
      $registrosPorPagina = $args["registros_por_pagina"];
      $desde = (($pagina-1)*$registrosPorPagina);
      $sql ="SELECT * FROM Reciclaje LIMIT $desde,$registrosPorPagina;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function numero_paginas($args)
   {
      $registrosPorPagina = $args["registros_por_pagina"];
      $sql ="SELECT IF(ceil(count(*)/$registrosPorPagina)>0,ceil(count(*)/$registrosPorPagina),1) as 'paginas' FROM Reciclaje;";
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
            $sql = "SELECT * FROM Reciclaje WHERE $nombreColumna = ?;";
            break;
         case "inicia":
            $sql = "SELECT * FROM Reciclaje WHERE $nombreColumna LIKE '$filtro%';";
            break;
         case "termina":
            $sql = "SELECT * FROM Reciclaje WHERE $nombreColumna LIKE '%$filtro';";
            break;
         default:
            $sql = "SELECT * FROM Reciclaje WHERE $nombreColumna LIKE '%$filtro%';";
            break;
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }
}