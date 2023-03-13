<?php

class generalconsult extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $generalconsult=new GeneralConsultModel();
        $response=$generalconsult->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $generalconsult=new GeneralConsultModel();
        $response=$generalconsult->get($param);
        $this->response($response);
    }
        
    /**
     * create
     *
     * @return
     */
    public function create(){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON); 
        $generalconsult = new GeneralConsultModel();
        $response = $generalconsult->create($object);
        $this->response($response);
    }
        
    /**
     * update
     *
     * @param  mixed $param
     * @return
     */
    public function update(){
        $inputJSON=file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $generalconsult = new GeneralConsultModel();
        $response = $generalconsult->update($object);
        $this->response($response);
    }
}
?>