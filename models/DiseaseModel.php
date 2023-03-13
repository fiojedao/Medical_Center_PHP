<?php

class DiseaseModel extends BaseModel {  
    
    /**
    * __construct
    *
    * @return void
    */
   public function __construct() {
       parent::__construct('diseases', 'code_id', new MySqlConnect());
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
    
    private function getId(){
        try {
            $code_id = "D-".$this->enlace->generateId(8);
            return $code_id;
        } catch (Exception $e) {
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
    
    /**
     * update
     *
     * @param  mixed $objeto
     * @param  mixed $id
     * @return void
     */
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