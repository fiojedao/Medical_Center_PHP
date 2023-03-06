<?php

class stock{
    public function index(){
        
        $stock=new StockModel();
        $response=$stock->all();
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
        
        $stock=new StockModel();
        $response=$stock->get($param);
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
        $stock=new StockModel();
        $response=$stock->create($object);
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
        $stock=new StockModel();
        $response=$stock->update($object);
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