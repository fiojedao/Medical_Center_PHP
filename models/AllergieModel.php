<?php

class AllergieModel {
    private $enlace;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->enlace = new BaseModel('allergies', 'code_id', new MySqlConnect());
    }
    
    /**
     * all
     *
     * @return void
     */
    public function all(){
        try {
			$vResultado = $this->enlace->find_all();
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id){
        try {

            $vResultado = $this->enlace->find_by_id($id);
            
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * create
     *
     * @param  mixed $objeto
     * @return void
     */
    public function create($objeto) {
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
    
    /**
     * update
     *
     * @param  mixed $objeto
     * @param  mixed $id
     * @return void
     */
    public function update($objeto,$id) {
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