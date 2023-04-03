<?php
abstract class BaseController {

    /**
     * response
     *
     * @param mixed $response
     * @return 
     */
    public function response($response){
        $json=isset($response) && !empty($response)?
        $this->body(200, $response):
        $this->body(400, $response);
        echo json_encode($json,http_response_code($json["status"]));
    }
    
    /**
     * getObj
     *
     * @return
     */
    public function getObj(){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON);
        return $object;
    }
    
    /**
     * body
     *
     * @param  mixed $code
     * @param  mixed $response
     * @return
     */
    private function body($code, $response){
        return $code == 200?array(
            'status'=>$code,
            'results'=>$response
        ):array(
            'status'=>$code,
            'total'=>0,
            'results'=>"No hay registros"
        );
    }
}
?>