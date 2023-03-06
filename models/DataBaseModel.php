<?php
class DataBaseModel {
    private $tabla;
    private $campoId;
    private $enlace;
    
    /**
     * __construct
     *
     * @param  mixed $tabla
     * @param  mixed $campoId
     * @return void
     */
    public function __construct($tabla, $campoId) {
        $this->enlace=new MySqlConnect();
        $this->tabla = $tabla;
        $this->campoId = $campoId;
    }
    
    /**
     * find_all
     *
     * @param  mixed $tabla nombre tabla
     * @return void
     */
    public function find_all() {
        try {
            $tabla = $this->tabla;
            $this->enlace->connect();

            $vSql = "SELECT * FROM $tabla;";

            $vResultado = $this->enlace->ExecuteSQL($vSql);
                
            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
            return false;
        }
    }
    
    
    /**
     * find_by_id
     *
     * @param  mixed $valor
     * @return void
     */
    public function find_by_id($valor) {
        try {
            $tabla = $this->tabla;
            $campoId = $this->campoId;
            $this->enlace->connect();

            $vSql = "SELECT * FROM $tabla WHERE $campoId = $valor;";
            
            $vResultado = $this->enlace->ExecuteSQL( $vSql);

            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
            return false;
        }
    }
    
    /**
     * create
     *
     * @param  mixed $keystabla - (campo1, campor2)
     * @param  mixed $valuestabla - (valor1, valor2)
     * @return void
     */
    public function create($keystabla, $valuestabla) {
        try {
            $tabla = $this->tabla;
            $this->enlace->connect();

            $sql =  "INSERT INTO $tabla $keystabla
                    VALUES $valuestabla";

            return $this->enlace->executeSQL_DML_last($sql);
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
            return false;
        }
    }
        
    /**
     * update
     *
     * @param  mixed $tablaSet - campo = valor, campo = valor
     * @param  mixed $valor - valor
     * @return void
     */
    public function update($tablaSet, $valor) {
        try {
            $tabla = $this->tabla;
            $campoId = $this->campoId;

            $this->enlace->connect();

			$sql = "UPDATE $tabla SET $tablaSet
                    WHERE $campoId = $valor";

			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->find_by_id($valor);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
            return false;
		}
    }
        
    /**
     * customUpdate
     *
     * @param  mixed $sql
     * @param  mixed $valor
     * @return void
     */
    public function customUpdate($sql, $valor) {
        try {
            $this->enlace->connect();

			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->find_by_id($valor);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
            return false;
		}
    }
}