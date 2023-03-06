<?php

class MedicationModel{
    private $enlace;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->enlace = new BaseModel('medications', 'code', new MySqlConnect());
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
            //Consulta sql
            $this->enlace->connect();
			$sql = "Insert into  medications (code, name, description, dose, type, created_date, updated_date)". 
                     "Values ('$objeto->code', '$objeto->name' ,'$objeto->description' ,'$objeto->dose' ,'$objeto->type' ,'$objeto->created_date', '$objeto->updated_date')";
	
			$idMedication = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idMedication);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * update
     *
     * @param  mixed $objeto
     * @return void
     */
    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "UPDATE  medications SET name ='$objeto->name',".
            " description='$objeto->description', dose='$objeto->dose', type='$objeto->type',  created_date=$objeto->created_date, updated_date='$objeto->updated_date'". 
            " Where code='$objeto->code'";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
            
            
            //Retornar 
            return $this->get($objeto->code);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }





   
}
?>