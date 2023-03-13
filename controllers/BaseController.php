<?php
abstract class BaseController {

    /**
     * response
     *
     * @param  mixed $response
     * @return void
     */
    public function response($response){
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

    public function getObj(){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON);
        return $object;
    }
}
?>