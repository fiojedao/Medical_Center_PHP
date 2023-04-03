<?php

class medication extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $instance = new MedicationModel();
        $response = $instance->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param mixed $param
     * @return
     */
    public function get($param){
        $instance = new MedicationModel();
        $response = $instance->get($param);
        $this->response($response);
    }
        
    /**
     * create
     *
     * @return
     */
    public function create(){
        $instance = (new MedicationModel());
        $object = $this->getObj();
        $response = $instance->create($object);
        $this->response($response);
    }
        
    /**
     * update
     *
     * @param mixed $param
     * @return
     */
    public function update(){
        $instance = (new MedicationModel());
        $object = $this->getObj();
        $response = $instance->update($object);
        $this->response($response);
    }
}
?>