<?php
//clase abstracta que permitira conectar a bd
abstract class Model
{
    private static $db_host = "localhost";
    private static $db_user = "root";
    private static $db_pass = "";
    private static $db_name= 'mexflix';
    private static $db_charset = 'utf8';
    private $conexion;
    
    protected $query;
    protected $rows = array();
    
    abstract protected function set();
    abstract protected function get();
    abstract protected function del();

    //metodo privado para conectar a la bd
    private function db_open()
    {
        //se usa self porque es un var static
        $this->conexion = new mysqli(
            self::$db_host,
            self::$db_user,
            self::$db_pass,
            self::$db_name
        );
        $this->conexion->set_charset(self::$db_charset);
    }
    //cerrar la conexion
    private function db_close()
    {
        $this->conexion->close();
    }
    //establece un query simple de tipo insert,DELETE,UPDATE
    protected function set_query()
    {
        $this->db_open();
        $this->conexion->query($this->query);
        $this->db_close();
    }
    //obtener datos del query en un array(select)
    //metodo get
    protected function get_query()
    {
        $this->db_open();
        $result = $this->conexion->query($this->query);
        //lo ejecutado en el query se guarda en el array
        while ($this->rows[] = $result->fetch_assoc());
        //libera el conjunto de resultados  
        $result->free();
        $this->db_close();
        //quita el ultimo elemento de un array porque su ultimo es null
        return array_pop($this->rows);
    }
}
