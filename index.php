<?php
require_once("./controllers/Autoload.php");
/* muesta las rutas */
$autoload= new Autoload();
/* si existe r que es enviada por la url  */
$route= isset($_GET['r']) ? $_GET['r'] : 'home';

$mexflix = new Router($route);
