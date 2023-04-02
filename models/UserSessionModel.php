<?php

class UserSessionModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        parent::__construct('user_sessions', 'id', new MySqlConnect());
    }

    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "US-".$this->generateId(8);
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
    
    function getUserByUserEmail($useremail) {
        try {
            $vResultado = $this->find_by_email($useremail);
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    function storeToken($userId, $token) {
        $query = "INSERT INTO tokens (user_id, token) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "is", $userId, $token);
        mysqli_stmt_execute($stmt);
    }

    function deleteToken($token) {
        $query = "DELETE FROM tokens WHERE token = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
    }

    function getTokenUserId($token) {
        $query = "SELECT user_id FROM tokens WHERE token = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 0) {
            return false;
        }

        $row = mysqli_fetch_assoc($result);
        return $row['user_id'];
    }
        
    /**
     * create
     *
     * @param  mixed $objeto
     * @return void
     */
    public function create($objeto) {
        try {
            $tuplas = "user_id,user_name,user_email,  session_token";

            $values = "'$objeto->user_id', 
            '$objeto->user_name', 
            '$objeto->user_email', 
            '$objeto->session_token'";

            $vResultado =  $this->createObj_Last($tuplas, $values);

            return $vResultado;
           
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    public function update($objeto) {
        try {
			$update = "user_id ='$objeto->user_id', user_name= '$objeto->user_name', user_email='$objeto->user_email' , session_token='$objeto->session_token', updated_date = CURRENT_TIMESTAMP()";

            $vResultado = null;

            if($this->updateById($update,$objeto->id) > 0){
                 $vResultado = $this->find_by_id($objeto->id);
            }

            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
  
}
?>