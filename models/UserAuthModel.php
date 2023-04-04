<?php
require_once "vendor/autoload.php";
use Firebase\JWT\JWT;

class UserAuthModel extends BaseModel {  
    private $secret_key = 'e0d17975bc9bd57eee132eecb6da6f11048e8a88506cc3bffc7249078cf2a77a';
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('users_auth', 'user_id', new MySqlConnect(), 'email');
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

    public function login($objeto) {
        $data = null;
        $jwt_token = null;

        $user = $this->find_by_email($objeto->useremail)[0];

        if(is_object($user) && isset($user) && !empty($user) && password_verify($objeto->password, $user->password)){
            $data=[
                'id'=>$user->user_id,
                'email'=>$user->email,
                'rol'=>$user->user_type_id
            ];
            $jwt_token = JWT::encode($data,$this->secret_key,'HS256');
        }

        return $jwt_token;
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
     * @param mixed $objeto
     * @return 
     */
    public function create($objeto) {
        try {
            $vResultado = new stdClass();
            $password = $this->cryptPassword($objeto->password);

            if($password == null)return;

            $exist = $this->existsRecord($objeto->username, $objeto->email);

            if($exist){
                $vResultado->err = "Cuenta existente";
                $vResultado->isValid = false;
                return $vResultado;
            }

            $tuplas = "user_id,username,password,email,user_type_id";
            $values = "'$objeto->user_id','$objeto->username','$password','$objeto->email',$objeto->user_type_id";

            $vResultado->isValid = ($this->createObj($tuplas, $values) > 0);
            return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function existsRecord($username, $email){
        try {
            $Sql = "SELECT COUNT(user_id) AS records
                        FROM users_auth
                        WHERE username = '$username' AND email = '$email';";
            
            $response = $this->customGet($Sql);
            $users_auth = $response[0];
            if(is_object($users_auth)){
                return (int)($users_auth->records) > 0;
            }
            throw new ErrorException();
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
            //Consulta sql
            $this->enlace->connect();
			//$sql = "UPDATE  users  SET name='$objeto-> name',  lastname_one='$objeto->lastname_one', lastname_two='$objeto->lastname_two ', genre='$objeto->genre',direction='$objeto->direction', date_of_birth='$objeto->date_of_birth', contact='$objeto->contact', emergency_contact'$objeto->emergency_contact',  blood_type='$objeto->blood_type',  updated_date = CURRENT_TIMESTAMP()". 
            //" Where user_id='$objeto->user_id'";
			
            //Ejecutar la consulta
			//$cResults = $this->enlace->executeSQL_DML( $sql);
            
            //Retornar 
            return null;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    private function cryptPassword($password){
        try {
            $response = null;
            if(isset($password)&& $password!=null){
				$crypt=password_hash($password, PASSWORD_BCRYPT);
				$response=$crypt;
			}
            return $response;
        } catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
 
}
?>