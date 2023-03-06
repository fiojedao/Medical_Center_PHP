<?php

class UserModel{
    private $enlace;

    public function __construct() {
        $this->enlace = new BaseModel('users', 'user_id', new MySqlConnect());
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

            $vResultado = $this->enlace->find_by_id($id);
            
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
	
    public function create($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "Insert into  users (user_id, name , lastname_one, lastname_two ,  genre , direction, date_of_birth, contact , emergency_contact, blood_type ,  created_date, updated_date)". 
                     "Values ('$objeto->user_id', '$objeto->name','$objeto->lastname_one','$objeto->lastname_two','$objeto->genre ','$objeto->direction','$objeto->date_of_birth','$objeto->contact','$objeto->blood_type', '$objeto->created_date', '$objeto->updated_date')";
	
			$idUser = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idUser);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "UPDATE  users  SET user_id ='$objeto->user_id',".
            "  name='$objeto-> name',  lastname_one='$objeto->lastname_one', lastname_two='$objeto->lastname_two ', genre='$objeto->genre',direction='$objeto->direction', date_of_birth='$objeto->date_of_birth', contact='$objeto->contact', emergency_contact'$objeto->emergency_contact',  blood_type='$objeto->blood_type', created_date=$objeto->created_date, updated_date='$objeto->updated_date'". 
            " Where user_id='$objeto->user_id'";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
            
            
            //Retornar 
            return $this->get($objeto->user_id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    

    
}
?>