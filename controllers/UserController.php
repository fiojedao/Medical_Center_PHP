<?php

class user extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $user=new UserModel();
        $response=$user->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $user=new UserModel();
        $response=$user->get($param);
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
        $user = new UserModel();
        $response = $user->create($object);
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
        $user = new UserModel();
        $response = $user->update($object);
        $this->response($response);
    }
}
?>