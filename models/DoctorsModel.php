<?php

class DoctorsModel{
    public $enlace;
    public function __construct() {
        $this->enlace=new MySqlConnect();
    }

    /*list */
    public function all(){
        try {
            //Consulta sql
            $vSql = "SELECT * FROM doctors;";
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
                
            // Retornar el objeto
            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }

    /*get by id*/
    public function get($id)
    {
        try {
            $vSql = "SELECT * FROM doctors WHERE doctor_id=$id";
            $this->enlace->connect();
            $vResultado = $this->enlace->ExecuteSQL( $vSql);

            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }

    /* Crear doctors */
    public function create($objeto) {
        try {
            $this->enlace->connect();
			$sql = "INSERT INTO doctors(doctor_id, 
                        name, 
                        medical_specialities_code)
                    VALUES('$objeto->doctor_id',
                        '$objeto->name',
                        '$objeto->medical_specialities_code')";
			
			$vResultado = $this->enlace->executeSQL_DML_last($sql);

            return $this->get($vResultado);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    /* Update doctors */
    public function update($objeto, $id) {
        try {
            $this->enlace->connect();
			$sql = "UPDATE doctors SET name ='$objeto->name',
                        medical_specialities_code ='$objeto->medical_specialities_code',
                        updated_date = CURRENT_TIMESTAMP() 
                    Where doctor_id=$id";
			
			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->get($id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>