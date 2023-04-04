<?php


class userauth extends BaseController {
    /**
     * index
     *
     * @return
     */
    public function index(){
        $instance = new UserModel();
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
        $instance = new UserModel();
        $response = $instance->get($param);
        $this->response($response);
    }
        
    /**
     * create
     *
     * @return
     */
    public function create(){
        $instance = (new UserModel());
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
        $instance = (new UserModel());
        $object = $this->getObj();
        $response = $instance->update($object);
        $this->response($response);
    }

    public function login(){
        $instance = (new UserAuthModel());
        $object = $this->getObj();
        $response = $instance->login($object);
        $this->response($response);
    }
}
?>