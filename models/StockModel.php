<?php

class StockModel{
    public $enlace;

       
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->enlace = new BaseModel('stock', 'id', new MySqlConnect());
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
			$sql = "Insert into stock ( medications_code, lot, expiration_date, description, entry_date, amount)". 
                     "Values ('$objeto->medications_code','$objeto->lot','$objeto->expiration_date','$objeto->description','$objeto->entry_date', $objeto->amount)";
	
			$idStock = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idStock);
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
			$sql = "UPDATE stock SET medications_code='$objeto->medications_code',".
            "lot ='$objeto->lot', expiration_date ='$objeto->expiration_date', description ='$objeto->description', entry_date ='$objeto->entry_date',  amount ='$objeto-> amount', updated_date = CURRENT_TIMESTAMP()". 
            " Where id='$objeto->id'";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
            
            
            //Retornar stock modificado
            return $this->get($objeto->id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }








   
}
?>