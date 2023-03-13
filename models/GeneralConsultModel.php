<?php

class GeneralConsultModel extends BaseModel {  
    
    /**
    * __construct
    *
    * @return void
    */
   public function __construct() {
       parent::__construct('general_consult', 'id_consult', new MySqlConnect());
   }  

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

    public function create($objeto) {
        try {
            $this->enlace->connect();
			$sql =  "INSERT INTO general_consult(doctor_id,
                        description,
                        price,
                        status)
                    VALUES ('$objeto->doctor_id',
                        '$objeto->description',
                        $objeto->price
                    )";

			$idgeneral_consult = $this->enlace->executeSQL_DML_last($sql);
            
            return $this->get($idgeneral_consult);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql =  "UPDATE general_consult SET date='$objeto->doctor_id',
                        description ='$objeto->description',
                        price =$objeto->price,
                        updated_date = CURRENT_TIMESTAMP()
                    WHERE id_consul=$objeto->id_consult";

            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->get($id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>