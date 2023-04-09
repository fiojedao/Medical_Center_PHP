<?php
abstract class BaseModel {
    //Listar en el API
    private $tabla;
    private $campoId;
    private $campoEmail;
    private $enlace;

    /**
     * __construct0
     *
     * @param mixed $tabla
     * @param mixed $campoId
     * @param mixed $enlace
     * @param mixed $campoEmail
     * @return
     */
    public function __construct() {
        $args = func_get_args();
        if (count($args) == 3) {
            $this->tabla = $args[0];
            $this->campoId = $args[1];
            $this->enlace = $args[2];
        } elseif (count($args) == 4) {
            $this->tabla = $args[0];
            $this->campoId = $args[1];
            $this->enlace = $args[2];
            $this->campoEmail = $args[3];
        }
    }
    
    
    /**
     * find_all
     *
     * @return "$obj";
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
        }
    }
    
    /**
     * find_by_id
     *
     * @param mixed $valor
     * @return "$obj";
     */
    public function find_by_id($param) {
        try {
            $tabla = $this->tabla;
            $campoId = $this->campoId;
            $this->enlace->connect();

            $valor = is_numeric($param) ? $param:"'$param'";

            $vSql = "SELECT * FROM $tabla WHERE $campoId = $valor;";

            $vResultado = $this->enlace->ExecuteSQL($vSql);

            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }
        
    /**
     * find_by_email
     *
     * @param mixed $param
     * @return
     */
    public function find_by_email($param) {
        try {
            $tabla = $this->tabla;
            $campoEmail = $this->campoEmail;
            $this->enlace->connect();

            $vSql = "SELECT * FROM $tabla WHERE $campoEmail='$param';";

            $vResultado = $this->enlace->ExecuteSQL( $vSql);

            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }
    
    /**
     * create
     *
     * @param mixed $keystabla - campo1, campor2
     * @param mixed $valuestabla - valor1, valor2
     * @return $vResultado;
     */
    public function createObj($keystabla, $valuestabla) {
        try {
            $tabla = $this->tabla;
            $this->enlace->connect();

            $vResultado = null;

            $sql =  "INSERT INTO $tabla($keystabla) VALUES($valuestabla);";

            $vResultado = $this->enlace->executeSQL_DML($sql);

            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }
    
    /**
     * create
     *
     * @param mixed $keystabla - campo1, campor2
     * @param mixed $valuestabla - valor1, valor2
     * @return $vResultado;
     */
    public function createObj_Last($keystabla, $valuestabla) {
        try {
            $tabla = $this->tabla;
            $this->enlace->connect();

            $vResultado = null;

            $sql =  "INSERT INTO $tabla($keystabla) VALUES($valuestabla)";

            $vResultado = $this->enlace->executeSQL_DML_last($sql);

            return $vResultado;
        } catch ( Exception $e ) {
            die ( $e->getMessage () );
        }
    }
        
    /**
     * update
     *
     * @param mixed $tablaSet - campo = valor, campo = valor
     * @param mixed $param - valor
     * @return "$obj";
     */
    public function updateById($tablaSet,$param) {
        try {
            $tabla = $this->tabla;
            $campoId = $this->campoId;

            $this->enlace->connect();
            $valor = is_numeric($param) ? $param:"'$param'";
			$sql = "UPDATE $tabla SET $tablaSet WHERE $campoId =$valor";
            
            if($valor != ""){
                $vresultado = $this->enlace->executeSQL_DML($sql);

                return $vresultado;
            }

            return null;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
        
    /**
     * customGet
     *
     * @param mixed $sql
     * @return "$obj";
     */
    public function customGet($sql) {
        try {
            $this->enlace->connect();
            return $this->enlace->ExecuteSQL($sql);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
        
    /**
     * customUpdate
     *
     * @param mixed $sql
     * @param mixed $valor
     * @return "$obj";
     */
    public function customUpdate($sql, $valor) {
        try {
            $this->enlace->connect();

			$cResults = $this->enlace->executeSQL_DML($sql);

            return $this->find_by_id($valor);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    
    /**
     * generateId
     *
     * @param mixed $pLength
     * @return "new Id"
     */
    public function generateId($pLength)
    {
        try {
            $vLength = isset($pLength) && !empty($pLength)? $pLength: 8;
            return bin2hex(random_bytes($vLength));
        } catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
    
    /**
     * delectById
     *
     * @param mixed $tabla
     * @param mixed $campoId
     * @param mixed $param
     * @return 
     */
    public function delectById($tabla,$campoId,$param) {
        try {
            $this->enlace->connect();
            $valor = is_numeric($param) ? $param:"'$param'";
			if(isset($valor) || $valor > 0){
                $sql = "DELETE FROM $tabla WHERE $campoId=$valor";
                return $this->enlace->executeSQL_DML($sql);
            }
            return null;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    
    /**
     * customSQL
     *
     * @param  mixed $sql
     * @return
     */
    public function customSQL($sql) {
        try {
            $this->enlace->connect();
            return $this->enlace->executeSQL_DML($sql);
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
}
?>