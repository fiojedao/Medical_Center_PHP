<?php

class AppointmentsModel extends BaseModel {
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('appointments', 'id', new MySqlConnect());
    }
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "A-".$this->generateId(8);
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
            $sql = "SELECT apnt.id, 
            apnt.description, 
            apnt.consulting_room, 
            apnt.status, 
            apnt_t.init_datetime, 
            apnt_t.end_datetime FROM appointments AS apnt
            INNER JOIN appointments_times AS apnt_t
            ON apnt_t.appointments_id = apnt.id;";
			$vResultado = $this->customGet($sql);
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
            $medical_record = new MedicalRecordsModel();
            $appointmetsTime = new AppointmentsTimesModel();

            $obj_medical_record = new stdClass();
            $obj_medical_record->user_id = $objeto->user_id;
            $obj_medical_record->doctor_id = $objeto->doctor_id;

            $medical_records_id = $medical_record->create($obj_medical_record);

            $tuplas = "date, description, medical_records_id, consulting_room, status";

            $values = "'$objeto->date','$objeto->description', $medical_records_id, '$objeto->consulting_room', '$objeto->status'";

            $appointments_id =  $this->createObj_Last($tuplas, $values);

            $obj_appointments = new stdClass();
            $obj_appointments->appointments_id = $appointments_id;
            $obj_appointments->init_datetime = $objeto->init_datetime;
            $obj_appointments->end_datetime = $objeto->end_datetime;

            $medical_records_id = $appointmetsTime->create($obj_appointments);

            $vResultado = $this->get($appointments_id);

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
			$update = "date='$objeto->date',
            description ='$objeto->description',
            medical_records_id =$objeto->medical_records_id,
            consulting_room ='$objeto->consulting_room',
            status ='$objeto->status'";
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