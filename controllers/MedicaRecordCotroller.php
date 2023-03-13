<?php

class medicalrecord extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $medicalrecord=new MedicalRecordsModel();
        $response=$medicalrecord->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $medicalrecord=new MedicalRecordsModel();
        $response=$medicalrecord->get($param);
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
        $medicalrecord = new MedicalRecordsModel();
        $response = $medicalrecord->create($object);
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
        $medicalrecord = new MedicalRecordsModel();
        $response = $medicalrecord->update($object);
        $this->response($response);
    }
}
?>