<?php

class MedicalRecordsModel{
    private $enlace;

    public function __construct() {
        $this->enlace = new BaseModel('medical_records', 'medical_records_id', new MySqlConnect());
    }

    public function all(){
        try {
			$vResultado = $this->enlace->find_all();
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {

            $doctorM=new DoctorModel();
            $userM=new UserModel();
            $allergiesM=new AllegiesModel();
            $deseasesM=new DiseasesModel();


            //Consulta sql
			$vSql = "SELECT * FROM medical_records where doctor_id=$id";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            $vResultado = $vResultado[0];

            $user=$userM->get($vResultado->user_id);
            $vResultado->user=$user;
           
            $doctor=$doctorM->get($vResultado->doctor_id);
            $vResultado->doctor=$doctor;

            //Listar allergies segun paciente
            $allergies=$allergiesM->getByMD($id);
            $vResultado->allergies= $allergies;

            //Listar enfermedadess segun paciente
            $diseases=$deseasesM->getByMD($id);
            $vResultado->diseases=$diseases;
           
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }


    public function create($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "Insert into medical_records (user_id, doctor_id, created_date, updated_date)". 
                     "Values ($objeto->user_id,$objeto->doctor_id, '$objeto->created_date', '$objeto->updated_date')";
	
			$idMedicalRecord = $this->enlace->executeSQL_DML_last( $sql);
           

            foreach( $objeto->allergies as $allergies){
                $dataAllergie[]=array($medical_record_id, $allergie_code);
            }
           
                
            foreach($dataAllergie as $row){
                $this->enlace->connect();
                $valores=implode(',', $row);
                $sql = "INSERT INTO nombre_tabla( medical_records_id, allergie_code) VALUES(".$valores.");";
                $vResultado = $this->enlace->executeSQL_DML($sql);
            }


            foreach( $objeto->diseases as $diseases){
                $dataDiseases[]=array($medical_record_id, $disease_code);
            }
               
                    
            foreach($dataDisease as $row){
                $this->enlace->connect();
                $valores=implode(',', $row);
                $sql = "INSERT INTO nombre_tabla( medical_records_id, disease_code) VALUES(".$valores.");";
                $vResultado = $this->enlace->executeSQL_DML($sql);
            }


                
            return $this->get($idMedicalRecord);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "UPDATE medical_records SET user_id =$objeto->user_id,".
            " doctor_id =$objeto->doctor_id, created_date ='$objeto->created_date', updated_date ='$objeto->updated_date'". 
            " Where medical_records_id=$objeto->medical_records_id";
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);

            //Borrar data de tabla intermedia medicalRecord-alergias

            $this->enlace->connect();
			$sql = "Delete from nombre_tabla Where medical_records_id=$objeto->medical_records_id";
			$cResults = $this->enlace->executeSQL_DML( $sql);


            //actualizar data de alergias
            
            foreach( $objeto->allergies as $allergies){
                $dataAllergie[]=array($medical_record_id, $allergie_code);
            }
           
                
            foreach($dataAllergie as $row){
                $this->enlace->connect();
                $valores=implode(',', $row);
                $sql = "INSERT INTO nombre_tabla( medical_records_id, allergies_code) VALUES(".$valores.");";
                $vResultado = $this->enlace->executeSQL_DML($sql);
            }


            

            //Borrar data de tabla intermedia meicalRecord-enfermedades

             $this->enlace->connect();
             $sql = "Delete from nombre_tabla Where medical_records_id=$objeto->medical_records_id";
             $cResults = $this->enlace->executeSQL_DML( $sql);

             //actualizar data de enfermedades
    
             foreach( $objeto->diseases as $diseases){
                $dataDiseases[]=array($medical_record_id, $disease_code);
            }
               
                    
            foreach($dataDisease as $row){
                $this->enlace->connect();
                $valores=implode(',', $row);
                $sql = "INSERT INTO nombre_tabla( medical_records_id, disease_code) VALUES(".$valores.");";
                $vResultado = $this->enlace->executeSQL_DML($sql);
            }

            
            
            //Retornar MedicalRecord
            return $this->get($objeto->medical_records_id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }





   
}
?>