<?php
/* Mostrar errores */
    ini_set('display_errors',1);
    ini_set("log_errors",1);
    ini_set("error_log","C:/xampp/htdocs/medical_center_api/php_error_log");
    /*Encabezada de las solicitudes*/
    /*CORS*/
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");  

    /* Requerimientos */
    date_default_timezone_set('America/Costa_Rica');
    require_once "controllers/BaseController.php";
    require_once "models/BaseModel.php";
    require_once "models/MySQLConnect.php";

    //Agregar todos los modelos
    require_once "models/AllergieModel.php";
    require_once "models/DiseasesModel.php";
    require_once "models/DoctorsModel.php";
    require_once "models/AppointmentsDoctorModel.php";
    require_once "models/MedicalRecordModel.php";
    require_once "models/MedicalSpecialitiesModel.php";
    require_once "models/MedicationModel.php";
    require_once "models/UserModel.php";
    require_once "models/UserSessionModel.php";
    require_once "models/UserAuthModel.php";
    require_once "models/AppointmentsModel.php";
    require_once "models/AppointmentsTimesModel.php";
    require_once "models/AllergyCategoryModel.php";
    require_once "models/DiseasesCategoryModel.php";
    

    //Agregar todos los controladores
    require_once "controllers/AllergiesController.php";
    require_once "controllers/DiseaseController.php";
    require_once "controllers/MedicalSpecialitiesController.php";
    require_once "controllers/MedicaRecordCotroller.php";
    require_once "controllers/MedicationController.php";
    require_once "controllers/UserController.php";
    require_once "controllers/DoctorsController.php";
    require_once "controllers/UserAuthController.php";
    require_once "controllers/UserSesionController.php";
    require_once "controllers/AppointmentsController.php";
    require_once "controllers/AppointmentsTimeController.php";
    require_once "controllers/AllergyCategoryController.php";
    require_once "controllers/DiseasesCategoryController.php";
    
    require_once "controllers/RoutesController.php";
    $index=new RoutesController();
    $index->index();
    ?>