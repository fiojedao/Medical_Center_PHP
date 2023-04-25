<?php

class appointments extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        //$this->autorize();
        $instance = new AppointmentsModel();
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
        $instance = new AppointmentsModel();
        $response = $instance->get($param);
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param mixed $param
     * @return
     */
    public function getbydoctor($param){
        //$this->autorize();
        $instance = new AppointmentsModel();
        $response = $instance->getbydoctor($param);
        $this->response($response);
    }
        
    /**
     * create
     *
     * @return
     */
    public function create(){
        //$this->autorize();
        $instance = (new AppointmentsModel());
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
        $instance = (new AppointmentsModel());
        $object = $this->getObj();
        $response = $instance->update($object);
        $this->response($response);
    }
        
    /**
     * delete
     *
     * @param mixed $param
     * @return
     */
    public function delete(){
        //$this->autorize();
        $instance = (new AppointmentsModel());
        $object = $this->getObj();
        $response = $instance->removeAppointment($object);
        $this->response($response);
    }
}
?>