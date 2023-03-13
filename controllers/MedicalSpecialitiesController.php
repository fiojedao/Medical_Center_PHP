<?php

class medicalspecialities extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $medicalspecialities=new MedicalSpecialitiesModel();
        $response=$medicalspecialities->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $medicalspecialities=new MedicalSpecialitiesModel();
        $response=$medicalspecialities->get($param);
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
        $medicalspecialities = new MedicalSpecialitiesModel();
        $response = $medicalspecialities->create($object);
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
        $medicalspecialities = new MedicalSpecialitiesModel();
        $response = $medicalspecialities->update($object);
        $this->response($response);
    }
}
?>