<?php

class medicationuser extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $medicationuser=new MedicationsUserModel();
        $response=$medicationuser->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $medicationuser=new MedicationsUserModel();
        $response=$medicationuser->get($param);
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
        $medicationuser = new MedicationsUserModel();
        $response = $medicationuser->create($object);
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
        $medicationuser = new MedicationsUserModel();
        $response = $medicationuser->update($object);
        $this->response($response);
    }
}
?>