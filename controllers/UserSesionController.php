<?php

class usersession extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $usersession=new UserSessionModel();
        $response=$usersession->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $usersession=new UserSessionModel();
        $response=$usersession->get($param);
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
        $usersession = new UserSessionModel();
        $response = $usersession->create($object);
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
        $usersession = new UserSessionModel();
        $response = $usersession->update($object);
        $this->response($response);
    }
}
?>