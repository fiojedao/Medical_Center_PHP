<?php

class UserModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        parent::__construct('users', 'id', new MySqlConnect());
    }
	
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "U-".$this->generateId(8);
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
            //Consulta sql
            $this->connect();
			$sql = "Insert into  users (user_id, name , lastname_one, lastname_two ,  genre , direction, date_of_birth, contact , emergency_contact, blood_type )". 
                     "Values ('$objeto->user_id', '$objeto->name','$objeto->lastname_one','$objeto->lastname_two','$objeto->genre ','$objeto->direction','$objeto->date_of_birth','$objeto->contact','$objeto->blood_type')";
	
			$idUser = $this->executeSQL_DML_last( $sql);
           
            return $this->get($idUser);
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
            //Consulta sql
            $this->connect();
			$sql = "UPDATE  users  SET name='$objeto-> name',  lastname_one='$objeto->lastname_one', lastname_two='$objeto->lastname_two ', genre='$objeto->genre',direction='$objeto->direction', date_of_birth='$objeto->date_of_birth', contact='$objeto->contact', emergency_contact'$objeto->emergency_contact',  blood_type='$objeto->blood_type',  updated_date = CURRENT_TIMESTAMP()". 
            " Where user_id='$objeto->user_id'";
			
            //Ejecutar la consulta
			$cResults = $this->executeSQL_DML( $sql);
            
            
            //Retornar 
            return $this->get($objeto->user_id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    

    
}
?>