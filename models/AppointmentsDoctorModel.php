<?php

class AppointmentsDoctorModel extends BaseModel {  
    
    /**
    * __construct
    *
    * @return 
    */
   public function __construct() {
       parent::__construct('appointment_doctors', 'appointment_id', new MySqlConnect());
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
            $tuplas = "appointment_id, doctor_id";
            $values = "$objeto->appointment_id,'$objeto->doctor_id'";
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
			$update = "appointment_id=$objeto->appointment_id,
            doctor_id ='$objeto->doctor_id',
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