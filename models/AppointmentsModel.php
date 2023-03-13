<?php

class AppointmentsModel{
    private $enlace;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->enlace = new BaseModel('appointments', 'id', new MySqlConnect());
    }    
    
    private function getId(){
        try {
            $code_id = "AP-".$this->enlace->generateId(8);
            return $code_id;
        } catch (Exception $e) {
            die ( $e->getMessage () );
        }
    }
    
    /**
     * all
     *
     * @return void
     */
    public function all(){
        try {
			$vResultado = $this->enlace->find_all();
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id){
        try {

            $vResultado = $this->enlace->find_by_id($id);
            
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
            $this->enlace->connect();
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

			$idAppointments = $this->enlace->executeSQL_DML_last($sql);
            
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
            $this->enlace->connect();
			$sql =  "UPDATE appointments SET date='$objeto->date',
                        description ='$objeto->description',
                        medical_records_id =$objeto->medical_records_id,
                        consulting_room ='$objeto->consulting_room',
                        status ='$objeto->status',
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