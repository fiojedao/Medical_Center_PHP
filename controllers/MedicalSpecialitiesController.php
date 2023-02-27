<?php

class medicalspecialities{
    public function index(){
        
        $alquiler=new AlquilerModel();
        $response=$alquiler->all();
        if(isset($response) && !empty($response)){
            $json=array(
                'status'=>200,
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
        http_response_code($json["status"]));
    }
    public function get($param){
        
        $alquiler=new MedicalSpecialitiesModel();
        $response=$alquiler->get($param);
        if(isset($response) && !empty($response)){
            $json=array(
                'status'=>200,
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
        http_response_code($json["status"]));
        
    }
    public function create(){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON); 
        $alquiler=new MedicalSpecialitiesModel();
        $response=$alquiler->create($object);
        if(isset($response) && !empty($response)){
            $json=array(
                'status'=>200,
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
        http_response_code($json["status"]));
        
    }
    public function update($param){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON); 
        $alquiler=new MedicalSpecialitiesModel();
        $response=$alquiler->update($param, $object);
        if(isset($response) && !empty($response)){
            $json=array(
                'status'=>200,
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
        http_response_code($json["status"]));
        
    }

}
?>