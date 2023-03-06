<?php

class StockModel{
    public $enlace;

   
    public function __construct() {
        
        $this->enlace=new MySqlConnect();
       
    }


    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM stock;";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM stock where id=$id";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);

           
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }


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