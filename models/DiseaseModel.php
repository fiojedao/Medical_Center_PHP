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
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "D-".$this->generateId(8);
            return $id;
        } catch (Exception $e) {
            die ( $e->getMessage () );
        }
    }
    
    /**
     * all
     *
     * @return $vResultado
     */
    public function all(){
        try {
			$vResultado = $this->find_all();
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * get
     *
     * @param  mixed $id
     * @return $vResultado
     */
    public function get($id){
        try {

            $vResultado = $this->find_by_id($id);
            
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
            $code_id = $this->getId();
            $tuplas = "code_id, name";

            $values = "'$code_id','$objeto->name'";

            $vResultado = null;

            if($this->createObj($tuplas, $values) > 0){
                $vResultado =  $this->find_by_id($code_id);
            }

            return $vResultado;
           
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

     //Obtener enfermedades segun id medical_record
     //REVISAR CONSULTA
    public function getByMD($id){
        try {
            //Consulta sql
			$vSql = "SELECT d.code_id, d.name, d.created_date, d.updated_date FROM diseases AS d, medical_record_diseases AS m WHERE d.code_id= m.diseases_code_id AND m.medical_record_id=$id;";
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