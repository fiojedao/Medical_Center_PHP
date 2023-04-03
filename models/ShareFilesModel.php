<?php

class ShareFilesModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('share_files', 'id', new MySqlConnect());
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
    
    /**
     * create
     *
     * @param mixed $objeto
     * @return 
     */
    public function create($objeto) {
        try {
            $tuplas = "medical_record_id, foreign_user_id";
            $values = "$objeto->medical_record_id,'$objeto->foreign_user_id'";
            $vResultado =  $this->createObj_Last($tuplas, $values);

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
			$update = "medical_record_id=$objeto-> medical_record_id,
            foreign_user_id='$objeto-> foreign_user_id', 
            updated_date = CURRENT_TIMESTAMP()";
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