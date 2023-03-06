<?php

class UserSessionModel{
    public $enlace;
    protected $session_token;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->enlace = new BaseModel('user_sessions', 'id', new MySqlConnect());
        session_start();
        $this->generate_token();
    }
    
    /**
     * get_session_token
     *
     * @return void
     */
    public function get_session_token() {
        return $this->session_token;
    }
    
    /**
     * generate_token
     *
     * @return void
     */
    protected function generate_token() {
        $this->session_token = bin2hex(random_bytes(32));
        $_SESSION['session_token'] = $this->session_token;
    }
    
    /**
     * validate_token
     *
     * @param  mixed $token
     * @return void
     */
    public function validate_token($token) {
        return $token === $this->session_token;
    }
    
    /**
     * all
     *
     * @return void
     */
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
    
    /**
     * create
     *
     * @param  mixed $objeto
     * @return void
     */
    public function create($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "Insert into  user_sessions (user_id, session_token )". 
                     "Values ('$objeto->user_id', '$objeto->session_token')";
	
			$idUserSession = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idUserSession);
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
            $this->enlace->connect();
			$sql = "UPDATE  user_sessions  SET user_id ='$objeto->user_id', session_token='$objeto->session_token', updated_date = CURRENT_TIMESTAMP()". 
            " Where id ='$objeto->id'";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
            
            
            //Retornar 
            return $this->get($objeto->id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }





   
}
?>