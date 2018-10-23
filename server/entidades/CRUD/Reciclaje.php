<?php
class Reciclaje
{
   public $id;
   public $idCaja;
   public $cantidad;
   public $fecha;
   public $idUsuario;

   function __construct($id,$idCaja,$cantidad,$fecha,$idUsuario){
      $this->id = $id;
      $this->idCaja = $idCaja;
      $this->cantidad = $cantidad;
      $this->fecha = $fecha;
      $this->idUsuario = $idUsuario;
   }
}
?>