<?php
/* Mostrar errores */
    ini_set('display_errors',1);
    ini_set("log_errors",1);
    ini_set("error_log","C:/xampp/htdocs/practica1/php_error_log");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    /* Requerimientos */
require_once "models/MySQLConnect.php";

//Agregar todos los modelos
require_once "models/DoctorsModel.php";
require_once "models/MedicalSpecialitiesModel.php";


//Agregar todos los controladores
require_once "controllers/DoctorsController.php";
require_once "controllers/MedicalSpecialitiesController.php";
    
    require_once "controllers/RoutesController.php";
    $index=new RoutesController();
    $index->index();

