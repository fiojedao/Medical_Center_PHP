<?php
require 'DataBaseModel.php';

class AlergieModel extends DataBaseModel {
    private $instance;

    public function __construct() {
        $this->get_instance();
    }

    private static function get_instance() {
      if (!isset($instance)) {
        $instance = new DataBaseModel('allergies', 'code_id');
      }
  
      return $instance;
    }

    public function all(){
        try {
            $this->get_instance()->find_all();
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM allergies WHERE code_id=$id";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function cresate($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql =  "INSERT INTO allergies(code_id,
                        name)
                    Values ('$objeto->code_id',
                        '$objeto->name')";

			$idAllergie = $this->enlace->executeSQL_DML_last($sql);
          
            //Retornar ALERGIAS
            return $this->get($idAllergie);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function updsate($objeto,$id) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql =  "UPDATE allergies SET name='$objeto->name',
                        updated_date = CURRENT_TIMESTAMP()
                    Where code_id=$id";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->get($id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

     //Obtener alergias segun id paciente
     //revisar consulta
    public function getByMD($id){
        try {
            //Consulta sql
			$vSql = "SELECT a.code_id, a.name, a.created_date, a.updated_date 
                    FROM allergies as a, medical_records as m 
                    where m.allergies_code_id=a.code_id and m.allergies_code_id=$id;";
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