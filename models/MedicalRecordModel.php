<?php

class MedicalRecordsModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return;
     */
    public function __construct() {
        parent::__construct('medical_records', 'medical_records_id', new MySqlConnect());
    }   
    
    private function getId(){
        try {
            $code_id = "MR-".$this->generateId(8);
            return $code_id;
        } catch (Exception $e) {
            die ( $e->getMessage () );
        }
    }
    
    /**
     * all
     *
     * @return;
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
     * @return;
     */
    public function get($id){
        try {
            //Consulta sql
			$vSql = "SELECT 
                        mr.medical_records_id, 
                        mr.user_id, 
                        mr.doctor_id, 
                        allergies.allergies_code_id,
                        allergies.name as allergies_name, 
                        diseases.diseases_code_id,
                        diseases.name as diseases_name, 
                        mr.created_date, 
                        mr.updated_date 
                    FROM medical_records as mr
                    INNER JOIN (
                            SELECT mra.user_id, mra.medical_record_id, mra.allergies_code_id, a.name 
                            FROM medical_record_allergies mra
                            INNER JOIN allergies a 
                                ON a.code_id = mra.allergies_code_id) as allergies
                        ON mr.medical_records_id = allergies.medical_record_id
                    INNER JOIN (
                            SELECT mrd.user_id, mrd.medical_record_id, mrd.diseases_code_id, d.name 
                            FROM medical_record_diseases mrd
                            INNER JOIN diseases d
                            ON d.code_id = mrd.diseases_code_id) as diseases
                    ON mr.medical_records_id = diseases.medical_record_id
                    WHERE mr.medical_records_id = $id;";

			 $vResultado = $this->customGet($vSql);
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    /**
     * create
     *
     * @param  mixed $objeto
     * @return
     */
    public function create($objeto) {
        try {
            $tuplas = "user_id, doctor_id";

            $values = "'$objeto->user_id','$objeto->doctor_id'";

            $vResultado =  $this->createObj_Last($tuplas, $values);

            return $vResultado;
           
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
 
    /**
     * update
     *
     * @param  mixed $objeto
     * @return
     */
    public function update($objeto) {
        try {
            //Consulta sql
            $this->connect();
			$sql = "UPDATE medical_records SET user_id =$objeto->user_id,".
            " doctor_id =$objeto->doctor_id, created_date ='$objeto->created_date', updated_date ='$objeto->updated_date'". 
            " Where medical_records_id=$objeto->medical_records_id";
            //Ejecutar la consulta
			$cResults = $this->executeSQL_DML( $sql);

            //Borrar data de tabla intermedia medicalRecord-alergias

            $this->connect();
			$sql = "Delete from nombre_tabla Where medical_records_id=$objeto->medical_records_id";
			$cResults = $this->executeSQL_DML( $sql);


            //actualizar data de alergias
            
            foreach( $objeto->allergies as $allergies){
                $dataAllergie[]=array($medical_record_id, $allergie_code);
            }
           
                
            foreach($dataAllergie as $row){
                $this->connect();
                $valores=implode(',', $row);
                $sql = "INSERT INTO nombre_tabla( medical_records_id, allergies_code) VALUES(".$valores.");";
                $vResultado = $this->executeSQL_DML($sql);
            }


            

            //Borrar data de tabla intermedia meicalRecord-enfermedades

             $this->connect();
             $sql = "Delete from nombre_tabla Where medical_records_id=$objeto->medical_records_id";
             $cResults = $this->executeSQL_DML( $sql);

             //actualizar data de enfermedades
    
             foreach( $objeto->diseases as $diseases){
                $dataDiseases[]=array($medical_record_id, $disease_code);
            }
               
                    
            foreach($dataDisease as $row){
                $this->connect();
                $valores=implode(',', $row);
                $sql = "INSERT INTO nombre_tabla( medical_records_id, disease_code) VALUES(".$valores.");";
                $vResultado = $this->executeSQL_DML($sql);
            }

            
            
            //Retornar MedicalRecord
            return $this->get($objeto->medical_records_id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>