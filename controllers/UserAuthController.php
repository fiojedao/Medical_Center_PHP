<?php


class userauth extends BaseController {
    /**
     * index
     *
     * @return
     */
    public function index(){
        //$this->autorize();
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
        //$this->autorize();
        $instance = new UserAuthModel();
        $response = $instance->get($param);
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
        $instance = (new UserAuthModel());
        $object = $this->getObj();
        $response = $instance->update($object);
        $this->response($response);
    }

    public function login(){
        //$this->autorize();
        $instance = (new UserAuthModel());
        $object = $this->getObj();
        $response = $instance->login($object);
        $this->response($response);
    }

    public function logout(){
        //$this->autorize();
        $instance = (new UserAuthModel());
        $object = $this->getObj();
        $response = $instance->logout($object);
        $this->response($response);
    }

    public function isauthenticate(){
        //$this->autorize();
        $instance = (new UserAuthModel());
        $object = $this->getObj();
        $response = $instance->verifyToken($object);
        $this->response($response);
    }
}
?>