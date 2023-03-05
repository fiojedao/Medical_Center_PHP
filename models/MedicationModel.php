<?php

class MedicationModel{
    public $enlace;

   
    public function __construct() {
        
        $this->enlace=new MySqlConnect();
       
    }


    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM medications;";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($code){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM medications where code='$code'";
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
			$sql = "Insert into  medications (code, name, description, dose, type, created_date, updated_date)". 
                     "Values ('$objeto->code', '$objeto->name' ,'$objeto->description' ,'$objeto->dose' ,'$objeto->type' ,'$objeto->created_date', '$objeto->updated_date')";
	
			$idMedication = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idMedication);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

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