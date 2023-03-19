<?php

class MedicationModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        parent::__construct('medications', 'code', new MySqlConnect());
    }
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "M-".$this->generateId(8);
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
            $code = $this->getId();
            $tuplas = "code, name, description, dose, type ";

            $values = "'$code','$objeto->name','$objeto->description' ,'$objeto->dose' ,'$objeto->type'";

            $vResultado = null;

            if($this->createObj($tuplas, $values) > 0){
                $vResultado =  $this->find_by_id($code);
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
     * @return void
     */
    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "UPDATE  medications SET name ='$objeto->name',".
            " description='$objeto->description', dose='$objeto->dose', type='$objeto->type', updated_date = CURRENT_TIMESTAMP()". 
            " Where code='$objeto->code'";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
            
            
            //Retornar 
            return $this->get($objeto->code);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }





   
}
?>