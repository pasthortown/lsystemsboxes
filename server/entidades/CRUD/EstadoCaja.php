<?php
class EstadoCaja
{
   public $id;
   public $cantidad;
   public $idEstado;
   public $idCaja;
   public $fecha;

   function __construct($id,$cantidad,$idEstado,$idCaja,$fecha){
      $this->id = $id;
      $this->cantidad = $cantidad;
      $this->idEstado = $idEstado;
      $this->idCaja = $idCaja;
      $this->fecha = $fecha;
   }
}
?>