<?php

class AppointmentsTimesModel extends BaseModel {  
    
    /**
    * __construct
    *
    * @return 
    */
   public function __construct() {
       parent::__construct('appointments_times', 'id', new MySqlConnect());
   }
    
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "AT-".$this->generateId(8);
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
            $tuplas = "appointments_id, init_datetime, end_datetime";
            $values = "$objeto->appointments_id,'$objeto->init_datetime', '$objeto->end_datetime'";
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
			$update = "appointments_id=$objeto->appointments_id,
            init_datetime ='$objeto->init_datetime',
            end_datetime =$objeto->end_datetime,
            updated_date = CURRENT_TIMESTAMP()";
            $vResultado = null;

            if($this->updateById($update,$objeto->id) > 0){
                 $vResultado = $this->find_by_id($objeto->id);
            }

            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>