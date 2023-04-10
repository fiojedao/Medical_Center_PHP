<?php

class doctors extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        //$this->autorize();
        $instance = new DoctorsModel();
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
        //$this->autorize();
        $instance = new DoctorsModel();
        $response = $instance->get($param);
        $this->response($response);
    }
        
    /**
     * create
     *
     * @return
     */
    public function create(){
        //$this->autorize();
        $instance = (new DoctorsModel());
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
        //$this->autorize();
        $instance = (new DoctorsModel());
        $object = $this->getObj();
        $response = $instance->update($object);
        $this->response($response);
    }
}
?>