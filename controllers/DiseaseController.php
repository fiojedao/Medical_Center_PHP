<?php

class diseases extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $this->autorize();
        $instance = new DiseaseModel();
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
        $this->autorize();
        $instance = new DiseaseModel();
        $response = $instance->get($param);
        $this->response($response);
    }
        
    /**
     * create
     *
     * @return
     */
    public function create(){
        $this->autorize();
        $instance = (new DiseaseModel());
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
        $this->autorize();
        $instance = (new DiseaseModel());
        $object = $this->getObj();
        $response = $instance->update($object);
        $this->response($response);
    }
 
    /**
     * getByUser
     *
     * @param  mixed $param
     * @return void
     */
    public function getByUser($param){
        $instance = new DiseaseModel();
        $response = $instance->getByUser($param);
        $this->response($response);
    }
    
    /**
     * updateBbyUser
     *
     * @param  mixed $param
     * @return void
     */
    public function  updateByUser($param){
        $instance = new DiseaseModel();
        $response = $instance->updateBbyUser($param);
        $this->response($response);
    }
    
    /**
     * deleteByUser
     *
     * @param  mixed $param
     * @return void
     */
    public function deleteByUser($param){
        $instance = new DiseaseModel();
        $response = $instance->deleteByUser($param);
        $this->response($response);
    }
}
?>