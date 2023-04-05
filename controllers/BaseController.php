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
        $json=array(
            'status'=>401,
            'result'=>"Error Processing Request: UNAUTHORIZED",
            'isValid'=> false
        );
        
        try {
            $token = null;
            $headers = apache_request_headers();
            
            if(isset($headers['Authorization'])){
              $matches = array();
              preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches);
              if(isset($matches[1])){
                $token = $matches[1];
                if ((new UserAuthModel())->verifyToken($token)) {
                    return true;
                }
              }
            }
            echo json_encode($json,http_response_code($json["status"]));
        } catch (Exception $e) {
            echo json_encode($json,http_response_code($json["status"]));
        }
        exit;
    }
}
?>