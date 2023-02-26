<?php

class CategoriaModel{
    public $enlace;

   
    public function __construct() {       
        $this->enlace=new MySqlConnect();       
    }
  
}
?>