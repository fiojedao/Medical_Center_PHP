<?php

class MedicalSpecialitiesModel{
    private $enlace;

    public function __construct() {
        $this->enlace = new BaseModel('medical_specialities', 'code_id', new MySqlConnect());
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