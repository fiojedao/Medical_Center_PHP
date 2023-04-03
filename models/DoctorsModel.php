<?php

class DoctorsModel extends BaseModel {  
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('doctors', 'doctor_id', new MySqlConnect());
    }
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "DT-".$this->generateId(8);
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
     * @param mixed $id
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

    /* Crear doctors */    
    /**
     * create
     *
     * @param mixed $objeto
     * @return 
     */
    public function create($objeto) {
        try {
            $code_id = $this->getId();
            $tuplas = "doctor_id, name,  medical_specialities_code";

            $values = "'$code_id','$objeto->name, '$objeto->medical_specialities_code''";

            $vResultado = null;

            if($this->createObj($tuplas, $values) > 0){
                $vResultado =  $this->find_by_id($code_id);
            }

            return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    /* Update doctors */
    public function update($objeto) {
        try {
			$update = "name='$objeto->name',
            medical_specialities_code='$objeto->medical_specialities_code',
            updated_date=CURRENT_TIMESTAMP()";

            $vResultado = null;

            if($this->updateById($update,$objeto->doctor_id) > 0){
                 $vResultado = $this->find_by_id($objeto->id);
            }

            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>