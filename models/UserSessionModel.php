<?php

class UserSessionModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('user_sessions', 'id', new MySqlConnect(), 'user_email');
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

        /**
     * get
     *
     * @param mixed $id
     * @return $vResultado
     */
    public function getToken($token){
        try {
            $vSql = "SELECT session_token AS token 
                FROM user_sessions 
                WHERE session_token='$token'";
            $resp = $this->customGet($vSql);
            return is_array($resp) && is_object($resp[0]) && isset($resp[0]);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    function getUserByUserEmail($useremail) {
        try {
            $vResultado = $this->find_by_email($useremail);
			return $vResultado;
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
            $tuplas = "user_id,user_name,user_email, session_token";

            $values = "'$objeto->user_id', 
            '$objeto->user_name', 
            '$objeto->user_email', 
            '$objeto->session_token'";

            $vResultado = $this->createObj_Last($tuplas, $values);

            return $vResultado;
           
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>