<?php
class Usuario
{
   public $id;
   public $identificacion;
   public $nombres;
   public $apellidos;
   public $latitudDireccionDomicilio;
   public $longitudDireccionDomicilio;
   public $email;
   public $telefono;

   function __construct($id,$identificacion,$nombres,$apellidos,$latitudDireccionDomicilio,$longitudDireccionDomicilio,$email,$telefono){
      $this->id = $id;
      $this->identificacion = $identificacion;
      $this->nombres = $nombres;
      $this->apellidos = $apellidos;
      $this->latitudDireccionDomicilio = $latitudDireccionDomicilio;
      $this->longitudDireccionDomicilio = $longitudDireccionDomicilio;
      $this->email = $email;
      $this->telefono = $telefono;
   }
}
?>