<?php

class DiseaseModel extends BaseModel {  
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('diseases', 'code_id', new MySqlConnect());
    }
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "D-".$this->generateId(8);
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
            $vSql = " SELECT d.code_id, d.name, dc.name as category, dc.category_id  from disease_category as dc  inner join diseases as d  on dc.category_id=d.id_category;";
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
     * @return
     */
    public function create($objeto) {
        try {
            $code_id = $this->getId();
            $tuplas = "code_id, name, id_category";
            $values = "'$code_id','$objeto->name', '$objeto->id_category'";
            $vResultado = null;

            if($this->createObj($tuplas, $values) > 0){
                $vResultado =  $this->find_by_id($code_id);
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
     * @return 
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
			$vSql = "SELECT mrd.diseases_code_id, d.name, u.user_id  FROM diseases AS d 
            INNER JOIN medical_record_diseases AS mrd ON mrd.diseases_code_id=d.code_id 
            INNER JOIN users AS u ON u.user_id=mrd.user_id WHERE u.user_id= $id;";

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
            $table= "medical_record_diseases";
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