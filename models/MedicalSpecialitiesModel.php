<?php

class MedicalSpecialitiesModel{
    public $enlace;
    public function __construct() {
        $this->enlace=new MySqlConnect();
    }

    /*List*/
    public function all(){
        try {
            //Consulta sql
            $vSql = "SELECT * FROM medical_specialities;";
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
                
            // Retornar el objeto
            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }

    /*Get bt id*/
    public function get($id)
    {
        try {

            $vSql = "SELECT * FROM medical_specialities WHERE id=$id";
            $this->enlace->connect();
            $vResultado = $this->enlace->ExecuteSQL( $vSql);
          
            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }

    /* Crear medical_specialities */
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

    /* Update medical_specialities */
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