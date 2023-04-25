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
     * get
     *
     * @param mixed $id
     * @return $vResultado
     */
    public function getbydoctor($id){
        try {
            $sql = "SELECT apnt.id, 
            apnt.description, 
            apnt.consulting_room, 
            apnt.status, 
            apnt_t.init_datetime, 
            apnt_t.end_datetime FROM appointments AS apnt
            INNER JOIN appointments_times AS apnt_t
            ON apnt_t.appointments_id = apnt.id
            INNER JOIN appointment_doctors AS apnt_d
            ON apnt_d.appointment_id = apnt.id
            where apnt_d.doctor_id = '$id'";
            $vResultado = $this->customGet($sql);
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
            
            $isExist = $this->existAppointment($objeto);
            if((int)($isExist) > 0){
                $obj= new stdClass();
                $obj->results = "Campo agendado";
                $obj->isValid = false;
                return $obj;
            }

            $medical_record = new MedicalRecordsModel();
            $appointmetsTime = new AppointmentsTimesModel();
            $appointmetsDoctor = new AppointmentsDoctorModel();

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

            
            $obj_appointments_doctor = new stdClass();
            $obj_appointments_doctor->appointment_id = $appointments_id;
            $obj_appointments_doctor->doctor_id = $objeto->doctor_id;

            
            $appointmetsDoctor->create($obj_appointments_doctor);

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

        
    /**
     * existAppointment
     *
     * @param mixed $objeto
     * @return stdClass
     */
    public function existAppointment($objeto) {
        try { 
            $vResult = new ArrayObject();

			$sql = "SELECT count(id) as exist FROM appointments_times appt_t
            INNER JOIN appointment_doctors appt_d ON 
            appt_d.appointment_id = appt_t.appointments_id and appt_d.doctor_id = '$objeto->doctor_id'
            WHERE (appt_t.init_datetime between cast('$objeto->init_datetime' as datetime) AND cast('$objeto->end_datetime' as datetime)) OR
            (appt_t.end_datetime between cast('$objeto->init_datetime' as datetime) AND cast('$objeto->end_datetime' as datetime)) OR 
            (appt_t.init_datetime between cast('$objeto->init_datetime' as datetime) AND cast('$objeto->end_datetime' as datetime) AND appt_t.end_datetime < cast('$objeto->init_datetime' as datetime)) OR
            (appt_t.init_datetime between cast('$objeto->init_datetime' as datetime) AND cast('$objeto->end_datetime' as datetime) AND appt_t.end_datetime > cast('$objeto->init_datetime' as datetime)) OR
            (appt_t.end_datetime between cast('$objeto->init_datetime' as datetime) AND cast('$objeto->end_datetime' as datetime) AND appt_t.init_datetime < cast('$objeto->end_datetime' as datetime)) OR
            (appt_t.end_datetime between cast('$objeto->init_datetime' as datetime) AND cast('$objeto->end_datetime' as datetime) AND appt_t.init_datetime > cast('$objeto->end_datetime' as datetime));";
            $vResult = $this->customGet($sql);
            return  $vResult[0]->exist;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

        
    /**
     * removeAppointment
     *
     * @param mixed $objeto
     * @return stdClass
     */
    public function removeAppointment($objeto) {
        try {
			if($objeto->id && $objeto->id > -1){
                $sql = "DELETE FROM appointment_doctors WHERE appointment_id = $objeto->id";
                $this->customSQL($sql);
                $sql = "DELETE FROM appointments_times WHERE appointments_id = $objeto->id";
                $this->customSQL($sql);
                $sql = "DELETE FROM appointments WHERE id = $objeto->id";
                $this->customSQL($sql);
                $vResult = new stdClass();
                $vResult->isRemoved = true;
            }
            return  $vResult;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>