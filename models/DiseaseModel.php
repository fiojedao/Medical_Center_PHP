<?php

class DiseaseModel{
    public $enlace;

    public function __construct() {
        $this->enlace=new MySqlConnect();
    }

    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM diseases;";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM diseases WHERE code_id=$id";
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
			$sql = "INSERT INTO diseases(code_id, 
                        name)
                    VALUES ('$objeto->code_id',
                        '$objeto->name')";
	
			$idDisease = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idDisease);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function update($objeto, $id) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "UPDATE diseases SET name='$objeto->name',
                        updated_date = CURRENT_TIMESTAMP()
                    WHERE code_id=$id";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);

            return $this->get($id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

     //Obtener enfermedades segun id paciente
     //REVISAR CONSULTA
    public function getByMD($id){
        try {
            //Consulta sql
			$vSql = "SELECT d.code_id, d.name, d.created_date, d.updated_date FROM diseases as d, medical_records as m where m.allergies_code_id=d.code_id and m.allergies_code_id=$id;";
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