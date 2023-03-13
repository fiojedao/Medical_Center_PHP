<?php

class stock extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $stock=new StockModel();
        $response=$stock->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        $stock=new StockModel();
        $response=$stock->get($param);
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
        $stock = new StockModel();
        $response = $stock->create($object);
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
        $stock = new StockModel();
        $response = $stock->update($object);
        $this->response($response);
    }
}
?>