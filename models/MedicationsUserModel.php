<?php

class MedicationsUserModel extends BaseModel {  
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        parent::__construct('medications_user', 'id', new MySqlConnect());
    }
    
    
    /**
     * getId
     *
     * @return $id
     */
    private function getId(){
        try {
            $id = "MU-".$this->generateId(8);
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
    
    /**
     * create
     *
     * @param  mixed $objeto
     * @return void
     */
    public function create($objeto) {
        try {
            $tuplas = "name, medical_records_id, stock_id ";

            $values = "'$objeto->name','$objeto->medical_records_id', $objeto->stock_id";

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
			$update = "name='$objeto->name',
            medical_records_id ='$objeto->medical_records_id',
            stock_id = $objeto->stock_id,
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