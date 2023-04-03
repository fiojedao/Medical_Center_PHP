<?php

class medicationuser extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $instance = new MedicationsUserModel();
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
        $instance = new MedicationsUserModel();
        $response = $instance->get($param);
        $this->response($response);
    }
        
    /**
     * create
     *
     * @return
     */
    public function create(){
        $instance = (new MedicationsUserModel());
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
        $instance = (new MedicationsUserModel());
        $object = $this->getObj();
        $response = $instance->update($object);
        $this->response($response);
    }
}
?>