<?php

class medication extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $medication=new MedicationModel();
        $response=$medication->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $medication=new MedicationModel();
        $response=$medication->get($param);
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
        $medication = new MedicationModel();
        $response = $medication->create($object);
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
        $medication = new MedicationModel();
        $response = $medication->update($object);
        $this->response($response);
    }
}
?>