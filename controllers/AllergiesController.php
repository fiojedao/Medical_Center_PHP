<?php

class allergies extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $allergie=new AllergieModel();
        $response=$allergie->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $allergie=new AllergieModel();
        $response=$allergie->get($param);
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
        $allergie = new AllergieModel();
        $response = $allergie->create($object);
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
        $allergie = new AllergieModel();
        $response = $allergie->update($object);
        $this->response($response);
    }
}
?>