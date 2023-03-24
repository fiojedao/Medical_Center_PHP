<?php

class AppointmentsModel extends BaseModel {
    /**
     * __construct
     *
     * @return void
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
            $this->connect();
			$sql =  "INSERT INTO appointments(date,
                        description,
                        medical_records_id,
                        consulting_room,
                        status)
                    VALUES ('$objeto->date',
                        '$objeto->description',
                        $objeto->medical_records_id,
                        '$objeto->consulting_room',
                        '$objeto->status'
                    )";

			$idAppointments = $this->executeSQL_DML_last($sql);
            
            return $this->get($idAppointments);
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
    public function update($objeto,$id) {
        try {
            //Consulta sql
            $this->connect();
			$sql =  "UPDATE appointments SET date='$objeto->date',
                        description ='$objeto->description',
                        medical_records_id =$objeto->medical_records_id,
                        consulting_room ='$objeto->consulting_room',
                        status ='$objeto->status',
                        updated_date = CURRENT_TIMESTAMP()
                    WHERE id=$id";

            //Ejecutar la consulta
			$cResults = $this->executeSQL_DML($sql);

            return $this->get($id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>