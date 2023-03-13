<?php

class MedicationsUserModel{
    public $enlace;

   
    public function __construct() {
        
        $this->enlace=new MySqlConnect();
       
    }  
    
    private function getId(){
        try {
            $code_id = "MU-".$this->enlace->generateId(8);
            return $code_id;
        } catch (Exception $e) {
            die ( $e->getMessage () );
        }
    }


    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM medications_user;";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function get($id){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM medications_user where id=$id";
			$this->enlace->connect();
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);

           
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }


    public function create($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "Insert into medications_user ( name, medical_records_id, stock_id)". 
                     "Values ('$objeto->name','$objeto->medical_records_id', $objeto->stock_id ,'$objeto->created_date', '$objeto->updated_date')";
	
			$idmedications_user = $this->enlace->executeSQL_DML_last( $sql);
           
            return $this->get($idmedications_user);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    public function update($objeto) {
        try {
            //Consulta sql
            $this->enlace->connect();
			$sql = "UPDATE medications_user SET name='$objeto->name',".
            "medical_records_id ='$objeto->medical_records_id', stock_id = $objeto->stock_id, updated_date = CURRENT_TIMESTAMP()". 
            " Where id='$objeto->id'";
			
            //Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML( $sql);
            
            
            //Retornar medications_user modificado
            return $this->get($objeto->id);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }








   
}
?>