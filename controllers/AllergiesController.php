<?php

class allergies {
    public function index(){
        
        $disease=new AllergieModel();
        $response=$disease->all();
        if(isset($response) && !empty($response)){
            $json=array(
                'status'=>200,
                'total'=>count($response),
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'total'=>0,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
        http_response_code($json["status"]));
    }
    public function get($param){
        
        $allergie=new AllergieModel();
        $response=$allergie->get($param);
        $json=array(
            'status'=>200,
            'results'=>$response
        );
       echo json_encode($json,
        http_response_code($json["status"]));
        
    }
    
    public function create( ){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON); 
        $allergie=new AllergieModel();
        $response=$allergie->create($object);
        if(isset($response) && !empty($response)){
            $json=array(
                'status'=>200,
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'total'=>0,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
        http_response_code($json["status"]));
        
    }
    public function update(){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON); 
        $allergie=new AllergieModel();
        $response=$allergie->update($object);
        if(isset($response) && !empty($response)){
            $json=array(
                'status'=>200,
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'total'=>0,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
        http_response_code($json["status"]));
        
    }

}
?>