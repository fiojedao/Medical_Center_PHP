<?php

class AlergieModel{
    public $enlace;

   
    public function __construct() {
        
        $this->enlace=new MySqlConnect();
       
    }


    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM allergies;";
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
			$vSql = "SELECT * FROM allergies where id=$id";
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
			$sql =  "Insert into allergies (code_id, name,  created_date, updated_date)". 
            "Values ('$objeto->code_id''$objeto->name','$objeto->created_date', '$objeto->updated_date')";

			$idAllergie = $this->enlace->executeSQL_DML_last( $sql);
         
                   
            //Retornar bicicleta
            return $this->get($idAllergie);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql =  "UPDATE allergies SET name='$objeto->name',".
            " created_date ='$objeto->created_date', updated_date ='$objeto->updated_date'". 
            " Where code_id='$objeto->code_id'";
			
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
        

         
            //Retornar bicicleta
            return $this->get($objeto->id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }


     //Obtener alergias segun id paciente
    public function getByMD($id){
        try {
            //Consulta sql
			$vSql = " SELECT a.code_id, a.name, a.created_date, a.updated_date FROM allergies as a, medical_records as m where m.allergies_code_id=a.code_id and m.allergies_code_id=$id;";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }




   
}
?>