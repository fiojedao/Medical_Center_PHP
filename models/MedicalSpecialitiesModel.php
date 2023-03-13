<?php

class MedicalSpecialitiesModel{
    private $enlace;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->enlace = new BaseModel('medical_specialities', 'code_id', new MySqlConnect());
    }  
    
    private function getId(){
        try {
            $code_id = "MS-".$this->enlace->generateId(8);
            return $code_id;
        } catch (Exception $e) {
            die ( $e->getMessage () );
        }
    }
    
    /**
     * all
     *
     * @return void
     */
    public function all(){
        try {
			$vResultado = $this->enlace->find_all();
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id){
        try {

            $vResultado = $this->enlace->find_by_id($id);
            
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * create
     *
     * @param  mixed $objeto
     * @return void
     */
    public function create($objeto) {
        try {
            $this->enlace->connect();
			$sql = "INSERT INTO medical_specialities (code, name, description)
            VALUES('$objeto->code','$objeto->name','$objeto->description')";
			
			$vResultado = $this->enlace->executeSQL_DML_last($sql);

            return $this->get($vResultado);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $objeto
     * @return void
     */
    public function update($id, $objeto) {
        try {
            $this->enlace->connect();
			$sql = "UPDATE medical_specialities SET code ='$objeto->code',name ='$objeto->name',description ='$objeto->description',updated_date = CURRENT_TIMESTAMP() Where id=$id";
			
			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->get($vResultado);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>