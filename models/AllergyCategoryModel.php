<?php

class AllergyCategoryModel extends BaseModel {
    
    /**
     * __construct
     *
     * @return 
     */
    public function __construct() {
        parent::__construct('allergy_category', 'category_id', new MySqlConnect());
    }
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "AC-".$this->generateId(8);
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

    /**
     * create
     *
     * @param mixed $objeto
     * @return $vResultado
     */
    public function create($objeto) {
        try {
            $code_id = $this->getId();
            $tuplas = "category_id, name";
            $values = "'$category_id','$objeto->name'";
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
			$update =  "name='$objeto->name', updated_date = CURRENT_TIMESTAMP()";
            $vResultado = null;

            if($this->updateById($update,$objeto->code_id) > 0){
                 $vResultado = $this->find_by_id($objeto->code_id);
            }
            return  $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>