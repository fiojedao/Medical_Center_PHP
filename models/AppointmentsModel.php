<?php

class AppointmentsModel{
    private $enlace;

    public function __construct() {
        $this->enlace = new BaseModel('appointments', 'id', new MySqlConnect());
    }

    public function all(){
        try {
			$vResultado = $this->enlace->findAll();
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM appointments where id=$id;";
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