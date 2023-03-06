<?php

class DoctorsModel{
    private $enlace;

    public function __construct() {
        $this->enlace = new BaseModel('doctors', 'doctor_id', new MySqlConnect());
    }

    public function all(){
        try {
			$vResultado = $this->enlace->find_all();
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {

            $vResultado = $this->enlace->find_by_id($id);
            
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