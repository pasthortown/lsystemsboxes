<?php
include_once('../controladores/Controlador_Base.php');
include_once('../entidades/CRUD/Caja.php');
class Controlador_caja_admin extends Controlador_Base
{/*
   function crear($args)
   {
      $caja = new Caja($args["id"],$args["codigo"],$args["latitudUbicacion"],$args["longitudUbicacion"],$args["direccion"],$args["ancho"],$args["largo"],$args["profundidad"]);
      $sql = "INSERT INTO Caja (codigo,latitudUbicacion,longitudUbicacion,direccion,ancho,largo,profundidad) VALUES (?,?,?,?,?,?,?);";
      $parametros = array($caja->codigo,$caja->latitudUbicacion,$caja->longitudUbicacion,$caja->direccion,$caja->ancho,$caja->largo,$caja->profundidad);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }*/
/*
   function actualizar($args)
   {
      $caja = new Caja($args["id"],$args["codigo"],$args["latitudUbicacion"],$args["longitudUbicacion"],$args["direccion"],$args["ancho"],$args["largo"],$args["profundidad"]);
      $parametros = array($caja->codigo,$caja->latitudUbicacion,$caja->longitudUbicacion,$caja->direccion,$caja->ancho,$caja->largo,$caja->profundidad,$caja->id);
      $sql = "UPDATE Caja SET codigo = ?,latitudUbicacion = ?,longitudUbicacion = ?,direccion = ?,ancho = ?,largo = ?,profundidad = ? WHERE id = ?;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }*/

   function leer($args)
   {
      $id = $args["id"];
      if ($id==""){
         $sql = "SELECT Caja.*, EstadoCaja.cantidad, Estado.descripcion as 'Estado', EstadoCaja.fecha, EstadoCaja.cantidad FROM Caja INNER JOIN EstadoCaja ON Caja.id = EstadoCaja.idCaja INNER JOIN Estado ON Estado.id = EstadoCaja.idEstado;";
      }else{
      $parametros = array($id);
         $sql = "SELECT Caja.*, EstadoCaja.cantidad, Estado.descripcion as 'Estado', EstadoCaja.fecha, EstadoCaja.cantidad FROM Caja INNER JOIN EstadoCaja ON Caja.id = EstadoCaja.idCaja INNER JOIN Estado ON Estado.id = EstadoCaja.idEstado WHERE Caja.id = ?;";
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function leer_paginado($args)
   {
      $pagina = $args["pagina"];
      $registrosPorPagina = $args["registros_por_pagina"];
      $desde = (($pagina-1)*$registrosPorPagina);
      $sql ="SELECT Caja.*, EstadoCaja.cantidad, Estado.descripcion as 'Estado', EstadoCaja.fecha, EstadoCaja.cantidad FROM Caja INNER JOIN EstadoCaja ON Caja.id = EstadoCaja.idCaja INNER JOIN Estado ON Estado.id = EstadoCaja.idEstado LIMIT $desde,$registrosPorPagina;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function numero_paginas($args)
   {
      $registrosPorPagina = $args["registros_por_pagina"];
      $sql ="SELECT IF(ceil(count(*)/$registrosPorPagina)>0,ceil(count(*)/$registrosPorPagina),1) as 'paginas' FROM Caja;";
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
            $sql = "SELECT Caja.*, EstadoCaja.cantidad, Estado.descripcion as 'Estado', EstadoCaja.fecha, EstadoCaja.cantidad FROM Caja INNER JOIN EstadoCaja ON Caja.id = EstadoCaja.idCaja INNER JOIN Estado ON Estado.id = EstadoCaja.idEstado WHERE $nombreColumna = ?;";
            break;
         case "inicia":
            $sql = "SELECT Caja.*, EstadoCaja.cantidad, Estado.descripcion as 'Estado', EstadoCaja.fecha, EstadoCaja.cantidad FROM Caja INNER JOIN EstadoCaja ON Caja.id = EstadoCaja.idCaja INNER JOIN Estado ON Estado.id = EstadoCaja.idEstado WHERE $nombreColumna LIKE '$filtro%';";
            break;
         case "termina":
            $sql = "SELECT Caja.*, EstadoCaja.cantidad, Estado.descripcion as 'Estado', EstadoCaja.fecha, EstadoCaja.cantidad FROM Caja INNER JOIN EstadoCaja ON Caja.id = EstadoCaja.idCaja INNER JOIN Estado ON Estado.id = EstadoCaja.idEstado WHERE $nombreColumna LIKE '%$filtro';";
            break;
         default:
            $sql = "SELECT Caja.*, EstadoCaja.cantidad, Estado.descripcion as 'Estado', EstadoCaja.fecha, EstadoCaja.cantidad FROM Caja INNER JOIN EstadoCaja ON Caja.id = EstadoCaja.idCaja INNER JOIN Estado ON Estado.id = EstadoCaja.idEstado WHERE $nombreColumna LIKE '%$filtro%';";
            break;
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }
}