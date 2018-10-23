<?php
class Caja
{
   public $id;
   public $codigo;
   public $latitudUbicacion;
   public $longitudUbicacion;
   public $direccion;
   public $ancho;
   public $largo;
   public $profundidad;

   function __construct($id,$codigo,$latitudUbicacion,$longitudUbicacion,$direccion,$ancho,$largo,$profundidad){
      $this->id = $id;
      $this->codigo = $codigo;
      $this->latitudUbicacion = $latitudUbicacion;
      $this->longitudUbicacion = $longitudUbicacion;
      $this->direccion = $direccion;
      $this->ancho = $ancho;
      $this->largo = $largo;
      $this->profundidad = $profundidad;
   }
}
?>