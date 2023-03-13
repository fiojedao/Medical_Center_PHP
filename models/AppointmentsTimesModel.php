<?php

class appointments_timesModel{
    public $enlace;

    public function __construct() {
        $this->enlace=new MySqlConnect();
    }  
    
    private function getId(){
        try {
            $code_id = "APTM-".$this->enlace->generateId(8);
            return $code_id;
        } catch (Exception $e) {
            die ( $e->getMessage () );
        }
    }

    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM appointments_times;";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM appointments_times where id=$id;";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
			// Retornar el objeto
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