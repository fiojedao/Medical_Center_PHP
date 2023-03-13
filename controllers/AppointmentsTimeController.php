<?php

class appointmentstimes extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $appointmentstimes=new AppointmentsTimesModel();
        $response=$appointmentstimes->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        
        $appointmentstimes=new AppointmentsTimesModel();
        $response=$appointmentstimes->get($param);
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
        $appointmentstimes = new AppointmentsTimesModel();
        $response = $appointmentstimes->create($object);
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
        $appointmentstimes = new AppointmentsTimesModel();
        $response = $appointmentstimes->update($object);
        $this->response($response);
    }
}
?>