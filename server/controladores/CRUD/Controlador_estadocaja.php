<?php
include_once('../controladores/Controlador_Base.php');
include_once('../entidades/CRUD/EstadoCaja.php');
class Controlador_estadocaja extends Controlador_Base
{
   function crear($args)
   {
      $estadocaja = new EstadoCaja($args["id"],$args["cantidad"],$args["idEstado"],$args["idCaja"],$args["fecha"]);
      $sql = "INSERT INTO EstadoCaja (cantidad,idEstado,idCaja,fecha) VALUES (?,?,?,?);";
      $fechaNoSQLTime = strtotime($estadocaja->fecha);
      $fechaSQLTime = date("Y-m-d H:i:s", $fechaNoSQLTime);
      $estadocaja->fecha = $fechaSQLTime;
      $parametros = array($estadocaja->cantidad,$estadocaja->idEstado,$estadocaja->idCaja,$estadocaja->fecha);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function actualizar($args)
   {
      $estadocaja = new EstadoCaja($args["id"],$args["cantidad"],$args["idEstado"],$args["idCaja"],$args["fecha"]);
      $parametros = array($estadocaja->cantidad,$estadocaja->idEstado,$estadocaja->idCaja,$estadocaja->fecha,$estadocaja->id);
      $sql = "UPDATE EstadoCaja SET cantidad = ?,idEstado = ?,idCaja = ?,fecha = ? WHERE id = ?;";
      $fechaNoSQLTime = strtotime($estadocaja->fecha);
      $fechaSQLTime = date("Y-m-d H:i:s", $fechaNoSQLTime);
      $estadocaja->fecha = $fechaSQLTime;
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
      $sql = "DELETE FROM EstadoCaja WHERE id = ?;";
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
         $sql = "SELECT * FROM EstadoCaja;";
      }else{
      $parametros = array($id);
         $sql = "SELECT * FROM EstadoCaja WHERE id = ?;";
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function leer_paginado($args)
   {
      $pagina = $args["pagina"];
      $registrosPorPagina = $args["registros_por_pagina"];
      $desde = (($pagina-1)*$registrosPorPagina);
      $sql ="SELECT * FROM EstadoCaja LIMIT $desde,$registrosPorPagina;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function numero_paginas($args)
   {
      $registrosPorPagina = $args["registros_por_pagina"];
      $sql ="SELECT IF(ceil(count(*)/$registrosPorPagina)>0,ceil(count(*)/$registrosPorPagina),1) as 'paginas' FROM EstadoCaja;";
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
            $sql = "SELECT * FROM EstadoCaja WHERE $nombreColumna = ?;";
            break;
         case "inicia":
            $sql = "SELECT * FROM EstadoCaja WHERE $nombreColumna LIKE '$filtro%';";
            break;
         case "termina":
            $sql = "SELECT * FROM EstadoCaja WHERE $nombreColumna LIKE '%$filtro';";
            break;
         default:
            $sql = "SELECT * FROM EstadoCaja WHERE $nombreColumna LIKE '%$filtro%';";
            break;
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }
}