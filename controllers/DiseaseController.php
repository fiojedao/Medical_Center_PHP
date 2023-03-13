<?php

class diseases extends BaseController {
        
    /**
     * index
     *
     * @return
     */
    public function index(){
        $disease=new DiseaseModel();
        $response=$disease->all();
        $this->response($response);
    }
        
    /**
     * get
     *
     * @param  mixed $param
     * @return
     */
    public function get($param){
        
        $disease=new DiseaseModel();
        $response=$disease->get($param);
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
        $disease = new DiseaseModel();
        $response = $disease->create($object);
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
        $disease = new DiseaseModel();
        $response = $disease->update($object);
        $this->response($response);
    }
}
?>