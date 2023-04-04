<?php
abstract class BaseController {

    /**
     * response
     *
     * @param mixed $response
     * @return 
     */
    public function response($response){
        $json=isset($response) && !empty($response)?$this->body(200, $response):$this->body(400, $response);
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
        switch ($code) {
            case 200:
                if(!is_array($response) && property_exists($response,'err')){
                    return array(
                        'status'=>409,
                        'results'=>$response->err,
                        'isValid'=>false
                    );
                } else {
                    return array(
                        'status'=>$code,
                        'results'=>$response,
                        'isValid'=>true
                    );
                }
                
            default:
                return array(
                    'status'=>$code,
                    'total'=>0,
                    'results'=>"No hay registros"
                );
        }
    }

    public function autorize(){   
        try {
            $token = null;
            $headers = apache_request_headers();
            if(isset($headers['Authentication'])){
              $matches = array();
              preg_match('/Bearer\s(\S+)/', $headers['Authentication'], $matches);
              if(isset($matches[1])){
                $token = $matches[1];
                return true;
              }
            } 
            return false;
                   
        } catch (Exception $e) {
            return false;
        }
    }
}
?>