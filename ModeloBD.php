<?php
class ModeloBD {
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = '';
    protected $db_name = '';
    protected $rows = array();
    private $conexion;

    #Constructor

    function __construct($db_name) {
        $this->db_name = $db_name;
    }

    # Conectar a la base de datos   

    public function open_connection() {
        $this->conexion = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
        $this->conexion->query("SET NAMES 'utf8'");
    }

    # Desconectar la base de datos

    public function close_connection() {
        $this->conexion->close();
    }

    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE

    public function execute_single_query($query) {
        $this->open_connection();
        $this->conexion->query($query);
        $this->close_connection();
    }

    # Almacenar resultados de una consulta en un Array

    public function get_results_from_query($query) {
        $this->open_connection();
        $result = $this->conexion->query($query);
        $filas = $result->num_rows;
        // Vacío el array para que no se me acumulen los valores
        unset($this->rows);
        for ($i = 0; $i < $filas; $i++) {
            $this->rows[] = $result->fetch_assoc();
        }

        if ($result != null)
            $result->close();
        $this->close_connection();
    }

    # Comprueba si el resultado de una consulta da alguna fila.

    public function exist_some_row($query) {
        $this->open_connection();
        $result = $this->conexion->query($query);
        $filas = $result->num_rows;
        $this->close_connection();
        if ($filas > 0) {
            return true;
        } else {
            return false;
        }
    }

    #Devuelve el número de filas de la última consulta realizada

    public function num_rows_cursor() {
        return count($this->rows);
    }

    #Devuelve un array asociativo con las filas de la última consulta

    public function get_rows() {
        if (isset($this->rows)){
            return $this->rows;
        }
        else{
            return null;
        }
    }
}
?>
