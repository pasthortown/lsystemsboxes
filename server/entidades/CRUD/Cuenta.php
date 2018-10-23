<?php
class Cuenta
{
   public $id;
   public $idUsuario;
   public $idRol;
   public $nickname;
   public $clave;

   function __construct($id,$idUsuario,$idRol,$nickname,$clave){
      $this->id = $id;
      $this->idUsuario = $idUsuario;
      $this->idRol = $idRol;
      $this->nickname = $nickname;
      $this->clave = $clave;
   }
}
?>