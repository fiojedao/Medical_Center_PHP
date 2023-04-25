<?php

class UserModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('users', 'user_id', new MySqlConnect());
    }

    /**
     * all
     *
     * @return $vResultado
     */
    public function all(){
        try {
            $sql = "SELECT u.id, u.user_id, u.name, u.lastname_one, u.lastname_two, u.genre, u.address, u.date_of_birth, u.contact, u.emergency_contact, u.blood_type,
                    ua.username, ua.email, ua.user_type_id FROM users u
                    INNER JOIN users_auth ua ON u.user_id = ua.user_id and user_type_id != 4;";
			$vResultado = $this->customGet($sql);
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * get
     *
     * @param mixed $id
     * @return $vResultado
     */
    public function get($id){
        try {

            $vResultado = $this->find_by_id($id);
            
			return $vResultado[0];
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * create
     *
     * @param mixed $objeto
     * @return 
     */
    public function create($objeto) {
        try {
            $response = null;
            $userauth = new UserAuthModel();
            $obj_userauth = new stdClass();
            $user_type_id = isset($objeto->user_type_id)&&($objeto->user_type_id!=null)?$objeto->user_type_id:3;

            $obj_userauth->user_id=$objeto->user_id;
            $obj_userauth->username=$objeto->username;
            $obj_userauth->password=$objeto->password;
            $obj_userauth->email=$objeto->email;
            $obj_userauth->user_type_id=$user_type_id;

            $respoonseAuth = $userauth->create($obj_userauth);
            if($respoonseAuth->isValid){
                $tuplas = "user_id,name,lastname_one,lastname_two,genre,address,date_of_birth,contact,emergency_contact,blood_type";

                $values = "'$objeto->user_id',
                '$objeto->name',
                '$objeto->lastname_one',
                '$objeto->lastname_two',
                '$objeto->genre ',
                '$objeto->address',
                '$objeto->date_of_birth',
                '$objeto->contact',
                '$objeto->emergency_contact',
                '$objeto->blood_type'";
                $vResultado = $this->createObj_Last($tuplas, $values);
                $response =  $this->find_by_id($vResultado);
            } else {
                $response = $respoonseAuth;
            }

            return $response;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
        
    /**
     * update
     *
     * @param mixed $objeto
     * @return 
     */
    public function update($objeto) {
        try {
			$update = "
            name='$objeto->name', 
            lastname_one='$objeto->lastname_one',
            lastname_two='$objeto->lastname_two', 
            genre='$objeto->genre', 
            address='$objeto->address',
            date_of_birth='$objeto->date_of_birth',
            contact='$objeto->contact', 
            emergency_contact='$objeto->emergency_contact',
            blood_type='$objeto->blood_type', 
            updated_date=CURRENT_TIMESTAMP()";

            $vResultado = null;

            if($this->updateById($update,$objeto->user_id) > 0){
                $vResultado = $this->find_by_id($objeto->user_id);
           }

            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>