<?php

class AppointmentsTimesModel extends BaseModel {  
    
    /**
    * __construct
    *
    * @return void
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

    public function create($objeto) {
        try {
            $this->enlace->connect();
			$sql =  "INSERT INTO appointments_times(appointments_id,
                        init_datetime,
                        end_datetime,
                        status)
                    VALUES ($objeto->appointments_id,
                        '$objeto->init_datetime',
                        $objeto->end_datetime
                    )";

			$idAppointments_times = $this->enlace->executeSQL_DML_last($sql);
            
            return $this->get($idAppointments_times);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function update($objeto,$id) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql =  "UPDATE appointments_times SET appointments_id=$objeto->appointments_id,
                        init_datetime ='$objeto->init_datetime',
                        end_datetime =$objeto->end_datetime,
                        updated_date = CURRENT_TIMESTAMP()
                    WHERE id=$id";

            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->get($id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>