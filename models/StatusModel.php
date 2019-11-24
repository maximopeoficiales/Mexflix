<?php

class StatusModel extends Model
{

    public function set($status_data = array())
    {
        foreach ($status_data as $key => $value) {
            /* https://www.php.net/manual/es/language.variables.variable.php */
            /* aqui se estan guardando los datos, que toman las datos y lo vuelve variable */
            $$key = $value;
        }
        $this->query = "REPLACE INTO status (status_id, status) VALUES ($status_id,'$status') ";
        $this->set_query();
    }
    public function get($status_id = '')
    {
        //si no esta vacio usa el where
        $this->query = ($status_id != '')
            ? "SELECT * FROM status WHERE status_id = $status_id"
            : "SELECT * FROM status";
        //este metodo me devolvera los datos en un array
        //envia query al metodo get query
        $this->get_query();
        
        $num_rows = count($this->rows);
        //echo $num_rows;
        $data = array();
        //recorre array rows, y luego al con array push agrega al $data lo que tiene rows
        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }
        return $data;
    }
   
    public function del($status_id = '')
    {
        $this->query = "DELETE FROM status WHERE status_id=$status_id";
        $this->set_query();
     }

    public function __destruct()
    {
        //destruir el objeto
        unset($this->db_name);
    }
}
