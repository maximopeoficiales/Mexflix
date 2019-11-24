<?php
/* Va a  validar si los usuarios existen */
class SessionController{
    private $session;

    public function __construct()
    {
        $this->session = new UsersModel();
        
    }
    public function login($user,$pass){
        /* valida y ejecuta el query */
        return $this->session-> validate_user($user,$pass);
    
    
    }
    public function logout(){
        session_start();
        session_destroy();
        header('Location: ./');
/* la variable de tipo session seria false 
entonces mostraria el formulario login */
    }
}