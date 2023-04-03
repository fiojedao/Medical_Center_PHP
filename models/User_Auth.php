<?php

class UserAuthModel  extends BaseModel {  
    
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('users_auth', 'user_id', new MySqlConnect());
    }
    
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "UA-".$this->generateId(8);
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
     * @param mixed $id
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

    public function login($username, $password) {
        $user = $this->db->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $token = bin2hex(random_bytes(32));
            $this->db->storeToken($user['id'], $token);
            return $token;
        }

        return false;
    }

    public function logout($token) {
        $this->db->deleteToken($token);
    }

    public function isAuthenticated($token) {
        return $this->db->getTokenUserId($token) !== false;
    }
	    
    /**
     * create
     *
     * @param  mixed $objeto
     * @return void
     */
    public function create($objeto) {
        try {
            $code_id = $this->getId();
            $tuplas = "user_id, username , password, email, user_type_id ";
            $values = "'$objeto->user_id', '$objeto->username','$objeto->password','$objeto->email', $objeto->user_type_id";
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
     * @return void
     */
    public function update($objeto) {
        try {
			$update = "password ='$objeto->password',
            updated_date = CURRENT_TIMESTAMP()";
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