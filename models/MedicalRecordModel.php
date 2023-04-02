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
     * @return void
     */
    public function create($objeto) {
        try {
            $tuplas = "user_id, doctor_id";

            $values = "'$objeto->user_id','$objeto->doctor_id'";

            $vResultado =  $this->createObj_Last($tuplas, $values);

            if(!empty($vResultado)){

            foreach( $objeto->allergies as $allergie_code){
                $dataAllergie[]=array($objeto->user_id, $objeto->medical_record_id, $allergie_code);
            }

            foreach($dataAllergie as $row){
                $this->connect();
                $values=implode(',', $row);
                $tuplas = "user_id, medical_records_id, allergies_code_id";
                $vResultado = null;
    
                if($this->createObj($tuplas, $values) == 0){
                    $vResultado =  "Error al crear registro tabla intermedia medicalRecord-alergias campos= " . $values;
                    return $vResultado;
                }
            }
            foreach( $objeto->diseases as $disease_code){
                $dataDiseases[]=array($objeto->user_id, $objeto->medical_record_id, $disease_code);
             }
             
             foreach($dataDisease as $row){
              $this->connect();
              $values=implode(',', $row);

              $tuplas = "user_id, medical_records_id, diseases_code_id";
              $vResultado = null;
  
              if($this->createObj($tuplas, $values) ==0){
                  $vResultado =  "Error al crear registro tabla intermedia medicalRecord-enfermedades campos= " . $values;
                  return $vResultado;
              }
              
             }
             return $vResultado;
            }    
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
 
    
    /**
     * update
     *
     * @param  mixed $objeto
     * @return void
     */
    public function update($objeto) {
        try {
			$update =  "user_id =$objeto->user_id,
             doctor_id =$objeto->doctor_id,
             created_date ='$objeto->created_date',
             updated_date ='$objeto->updated_date'";
            $vResultado = null;

            if($this->updateById($update,$objeto->medical_records_id) > 0){
                
                $vResultadoDelect = null;
                $nombretabla=null;
                $nombretabla="medical_record_diseases";
                $nombreCampo="medical_record_id";
                if( $vResultadoDelect = $this->delectById($nombretabla, $nombreCampo,$objeto->medical_records_id)>0){
                    //actualizar data de alergias
                    foreach( $objeto->allergies as $allergie_code){
                        $dataAllergie[]=array($objeto->user_id, $objeto->medical_record_id, $allergie_code);
                    }

                    foreach($dataAllergie as $row){
                        $this->connect();
                        $values=implode(',', $row);
                        $tuplas = "user_id, medical_records_id, allergies_code_id";
                        $vResultado = null;
            
                        if($this->createObj($tuplas, $values) == 0){
                            $vResultado =  "Error al crear registro tabla intermedia medicalRecord-alergias campos= " . $values;
                            return $vResultado;
                        }
                        
                    }
                }
                $vResultadoDelect = null;
                $nombretabla=null;
                $nombretabla="medical_record_allergies";
                if( $vResultadoDelect = $this->delectById($nombretabla, $nombreCampo,$objeto->medical_records_id)>0){
                    //actualizar data de enfermedades
                    foreach( $objeto->diseases as $disease_code){
                       $dataDiseases[]=array($objeto->user_id, $objeto->medical_record_id, $disease_code);
                    }
                    
                    foreach($dataDisease as $row){
                     $this->connect();
                     $values=implode(',', $row);

                     $tuplas = "user_id, medical_records_id, diseases_code_id";
                     $vResultado = null;
         
                     if($this->createObj($tuplas, $values) ==0){
                         $vResultado =  "Error al crear registro tabla intermedia medicalRecord-enfermedades campos= " . $values;
                         return $vResultado;
                     }
                     
                    }
                }
                $vResultado = $this->find_by_id($objeto->medical_records_id);
                return  $vResultado;
            }
            
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>