<?php

class  allergycategory extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        //$this->autorize();
        $instance = new AllergyCategoryModel();
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
        $instance = new  AllergyCategoryModel();
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
        $instance = new AllergyCategoryModel();
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
        $instance = new  AllergyCategoryModel();
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
        $instance = new  AllergyCategoryModel();
        $response = $instance->getByUser($param);
        $this->response($response);
    }
    
    /**
     * updateByUser
     *
     * @param  mixed $param
     * @return void
     */
    public function  updateByUser($param){
        $instance = new  AllergyCategoryModel();
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
        $instance = new  AllergyCategoryModel();
        $response = $instance->deleteByUser($param);
        $this->response($response);
    }

    
}
?>