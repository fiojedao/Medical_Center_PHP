<?php

class DoctorsModel{
    public $enlace;
    public function __construct() {
        $this->enlace=new MySqlConnect();
    }

    /*Listar */
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

    /*Obtener Por id*/
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
			$sql = "INSERT INTO doctors (doctor_id, name, specialty_code)
            VALUES('$objeto->doctor_id','$objeto->name','$objeto->specialty_code')";
			
			$vResultado = $this->enlace->executeSQL_DML_last($sql);

            return $this->get($vResultado);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    /* Crear doctors */
    public function update($id, $objeto) {
        try {
            $this->enlace->connect();
			$sql = "UPDATE doctors SET name ='$objeto->name',specialty_code ='$objeto->specialty_code',updated_date = CURRENT_TIMESTAMP() Where doctor_id=$objeto->$id";
			
			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->get($vResultado);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>