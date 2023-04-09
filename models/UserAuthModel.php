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
			return $this->find_all();
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
    public function getbyId($id){
        try {
			return $this->find_by_id($id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function login($objeto) {
        $data = null;
        $jwt_token = null;

        $user = $this->find_by_email($objeto->useremail)[0];
        $locatedate = date("d-m-Y h:i:s");
        if(is_object($user) && isset($user) && !empty($user) && password_verify($objeto->password, $user->password)){
            $data=[
                'id'=>$user->user_id,
                'email'=>$user->email,
                'rol'=>$user->user_type_id,
                'time'=>$locatedate
            ];
            $jwt_token = JWT::encode($data,$this->secret_key,'HS256');
            $this->createSession($jwt_token,$user);
        }

        return $jwt_token;
    }

    private function createSession($token, $userAuth) {
        try {
            $sessionm = new UserSessionModel();
            $exist = $sessionm->getUserByUserEmail($userAuth->email);

            if(is_array($exist) && is_object($exist[0]) && isset($exist[0])) return;

            $obj = new stdClass();

            $obj->user_id=$userAuth->user_id;
            $obj->user_name=$userAuth->username;
            $obj->user_email=$userAuth->email;
            $obj->session_token=$token;
            $sessionm->create($obj);
        } catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function logout($objeto) {
        try {
            $resp = (new UserSessionModel())->removeToken($objeto->useremail,$objeto->token);
            $obj = new stdClass();
            $obj->logout=$resp;
            return $obj;
        } catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function verifyToken($token){
        return (new UserSessionModel())->getToken($token);
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
                $vResultado->error = "Cuenta existente";
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

    protected function cryptPassword($password){
        try {
            $response = null;
            if(isset($password)&& $password!=null){
				$response=password_hash($password, PASSWORD_BCRYPT);
			}
            return $response;
        } catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>