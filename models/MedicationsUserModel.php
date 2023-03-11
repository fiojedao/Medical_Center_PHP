<?php

class MedicationsUserModel{
    public $enlace;

       
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->enlace = new BaseModel('medications_user', 'id', new MySqlConnect());
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


    public function create($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "Insert into medications_user ( name, medical_records_id, stock_id)". 
                     "Values ('$objeto->name','$objeto->medical_records_id', $objeto->stock_id ,'$objeto->created_date', '$objeto->updated_date')";
	
			$idmedications_user = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idmedications_user);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "UPDATE medications_user SET name='$objeto->name',".
            "medical_records_id ='$objeto->medical_records_id', stock_id = $objeto->stock_id, updated_date = CURRENT_TIMESTAMP()". 
            " Where id='$objeto->id'";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
            
            
            //Retornar medications_user modificado
            return $this->get($objeto->id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }








   
}
?>