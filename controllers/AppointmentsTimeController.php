<?php

class AppointmentsTimes{
    public function index(){
        
        $appointmentsTimes=new AppointmentsTimesModel();
        $response=$appointmentsTimes->all();
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
        
        $appointmentsTimes=new AppointmentsTimesModel();
        $response=$appointmentsTimes->get($param);
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
        $appointmentsTimes=new AppointmentsTimesModel();
        $response=$appointmentsTimes->create($object);
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
        $appointmentsTimes=new AppointmentsTimesModel();
        $response=$appointmentsTimes->update($object);
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