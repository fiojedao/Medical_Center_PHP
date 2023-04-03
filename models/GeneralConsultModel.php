<?php

class GeneralConsultModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return
     */
    public function __construct() {
        parent::__construct('general_consult', 'id_consult', new MySqlConnect());
    }
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "GC-".$this->generateId(8);
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
    
    /**
     * create
     *
     * @param mixed $objeto
     * @return
     */
    public function create($objeto) {
        try {
            $tuplas = "doctor_id, 
            description, 
            price,status";

            $values = "$objeto->doctor_id',
            '$objeto->description',
            $objeto->price";

            $vResultado =  $this->createObj_Last($tuplas, $values);

            return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * update
     *
     * @param mixed $objeto
     * @return
     */
    public function update($objeto) {
        try {
			$update = "doctor_id='$objeto->doctor_id',
            description='$objeto->description',
            price=$objeto->price,
            updated_date=CURRENT_TIMESTAMP()";

            $vResultado = null;

            if($this->updateById($update,$objeto->id_consult) > 0){
                 $vResultado = $this->find_by_id($objeto->id_consult);
            }
            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>