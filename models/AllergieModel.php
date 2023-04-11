<?php

class AllergieModel extends BaseModel {
    
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('allergies', 'code_id', new MySqlConnect());
    }
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "AL-".$this->generateId(8);
            return $id;
        } catch (Exception $e) {
            die ( $e->getMessage () );
        }
    }
        
    /**
     * all
     *
     * @return void
     */
    public function all(){
        try {
            $vSql = "SELECT a.code_id, a.name, ac.name as category, ac.category_id  from allergy_category as ac  inner join allergies as a  on ac.category_id=a.id_category;";
            $resp = $this->customGet($vSql);
            return $resp;
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
            $vResultado = $this->find_by_id($id);
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
        }
    }
        
    /**
     * create
     *
     * @param mixed $objeto
     * @return $vResultado
     */
    public function create($objeto) {
        try {
            $code_id = $this->getId();
            $tuplas = "code_id, name, id_category";
            $values = "'$code_id','$objeto->name', '$objeto->id_category'";
            $vResultado = null;

            if($this->createObj($tuplas, $values) > 0){
                $vResultado = $this->find_by_id($code_id);
            }

            return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    
    /**
     * update
     *
     * @param mixed $objeto
     * @return $vResultado
     */
    public function update($objeto) {
        try {
			$update =  "name='$objeto->name', id_category = '$objeto->id_category', updated_date = CURRENT_TIMESTAMP()";
            $vResultado = null;

            if($this->updateById($update,$objeto->code_id) > 0){
                 $vResultado = $this->find_by_id($objeto->code_id);
            }
            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * getByUser
     *
     * @param  mixed $id
     * @return void
     */
    public function getByUser($id){
        try {
            //Consulta sql
			$vSql = " SELECT mra.allergies_code_id, a.name, u.user_id 
            FROM allergies AS a INNER JOIN medical_record_allergies AS mra 
            ON mra.allergies_code_id=a.code_id INNER JOIN users AS u 
            ON u.user_id=mra.user_id WHERE u.user_id=$id;";

			 $vResultado = $this->customGet($vSql);
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
}
     
    /**
     * updateByUser
     *
     * @param  mixed $objeto
     * @param  mixed $id
     * @return void
     */
    public function updateByUser($objeto, $id) {
        try {
			$update = "name ='$objeto->name',
            updated_date = CURRENT_TIMESTAMP()";
            $vResultado = null;

            if($this->updateById($update,$objeto->doctor_id) > 0){
                 $vResultado = $this->find_by_id($objeto->id);
            }

            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
        
    /**
     * deleteByUser
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteByUser($id){
        try {
            $table= "medical_record_allergies";
			$field =  "user_id";

            if($this->delectById( $table, $field ,$id) > 0){
                 $vResultado = $this->find_by_id($objeto->id);
            }

            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

}

?>