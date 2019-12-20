<?php

class UsersModel extends Model
{

    public function set($user_data = array())
    {
        foreach ($user_data as $key => $value) {
            /* https://www.php.net/manual/es/language.variables.variable.php */
            /* aqui se estan guardando los datos, que toman las datos y lo vuelve variable */
            $$key = $value;
        }
        $this->query = "REPLACE INTO users (user,email,name,birthday,pass,role) 
        VALUES ('$user','$email','$name','$birthday',MD5('$pass'),'$role') ";
        $this->set_query();
    }
    public function get($user = '')
    {
        //si no esta vacio usa el where
        $this->query = ($user != '')
            ? "SELECT * FROM users WHERE user = '$user'"
            : "SELECT * FROM users";
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

    public function del($user = '')
    {
        $this->query = "DELETE FROM users WHERE user='$user'";
        /* No obtiene datos solo ejecuta el query */
        $this->set_query();
    }
    public function validate_user($user, $pass)
    {
        $this->query = "SELECT * FROM users 
        WHERE user = '$user' AND pass = MD5('$pass') ";

        $this->get_query();

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }
        /* arreglo lleno con los datos */
        return $data;
    }


    /* No es necesario destruir  */
}
