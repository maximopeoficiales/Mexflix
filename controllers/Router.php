<?php
class Router
{
    public $route;
    public function __construct($route)
    {
        $options = array(
            'use_only_cookies' => 1,
            'auto_start' => 1,
            'read_and_close' => true
        );

        #SI NO EXISTE UNA SESSION
        if (!isset($_SESSION)) session_start($options);

        if (!isset($_SESSION['ok']))  $_SESSION['ok'] = false;

        if ($_SESSION['ok']) {
            # programacion de la web
            $this->route = isset($_GET['r']) ? $_GET['r'] : 'home';
            $controller = new ViewController();
            switch ($this->route) {
                case 'home':
                    $controller->load_view('home');
                    break;
                case 'movieseries' :
                    $controller->load_view('movieseries');
                    break;
                case 'usuarios':
                    $controller->load_view('users');
                    break;
                    case 'status':
                        $controller->load_view('status');
                        break;
                    case 'salir':
                        $user_session = new SessionController();
                        $sesion = $user_session->logout();
                        break;
                default:
                $controller->load_view('error404');
                    break;
            }
          


        } else {
            /* valida si han sido enviado datos por post */
            if (!isset($_POST['user']) && !isset($_POST['pass'])) {
                # mostrar formulario de autentificacion
                $login_form = new ViewController();
                $login_form->load_view('login');
            } else {
                $user_session = new SessionController();
                /* se le envia al controlador y luego ejecuta en model */
                $sesion = $user_session->login($_POST['user'], $_POST['pass']);
                /* empty si es ta vacio */
                if (empty($sesion)) {/* 
                    echo 'El usuario y el password son incorrectas'; */
                    //envia al formulario login
                    $login_form = new ViewController();
                    $login_form->load_view('login');
                     /* cambia el flujo del programa a  */
                    header('Location: ./?error=EL USUARIO ' . $_POST['user']
                        . ' y el password proporcionado no coinciden');
                } else {
                    /* echo 'El usuario y el password son correctos'; */
                    $_SESSION['ok'] = true;
                    /* var_dump($sesion); */
                    foreach ($sesion as $row) {
                        /* los datos se estan guardando en variables sesion */
                        $_SESSION['user']= $row['user'];
                        $_SESSION['email']= $row['email'];
                        $_SESSION['name']= $row['name'];
                        $_SESSION['birthday']= $row['birthday'];
                        $_SESSION['pass']= $row['pass'];
                        $_SESSION['role']= $row['role'];

                    }
                    header('Location: ./');/* vuelve a cargar la pagina pero con una sesion activa */
                }
            }
        }
    }
}
