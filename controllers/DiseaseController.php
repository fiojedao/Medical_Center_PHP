<?php

class diseases{
        
    /**
     * index
     *
     * @return void
     */
    public function index(){
        $disease=new DiseaseModel();
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
        
    /**
     * get
     *
     * @param  mixed $param
     * @return void
     */
    public function get($param){
        
        $disease=new DiseaseModel();
        $response=$disease->get($param);
        $json=array(
            'status'=>200,
            'results'=>$response
        );
       echo json_encode($json,
        http_response_code($json["status"]));
        
    }
        
    /**
     * create
     *
     * @return void
     */
    public function create( ){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON); 
        $disease=new DiseaseModel();
        $response=$disease->create($object);
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
        
    /**
     * update
     *
     * @param  mixed $param
     * @return void
     */
    public function update($param){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON); 
        $disease=new DiseaseModel();
        $response=$disease->update($object,$param);
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