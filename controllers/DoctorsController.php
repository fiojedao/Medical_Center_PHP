<?php

class doctors extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $doctors=new DoctorsModel();
        $response=$doctors->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $doctors=new DoctorsModel();
        $response=$doctors->get($param);
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
        $doctors = new DoctorsModel();
        $response = $doctors->create($object);
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
        $doctors = new DoctorsModel();
        $response = $doctors->update($object);
        $this->response($response);
    }
}
?>