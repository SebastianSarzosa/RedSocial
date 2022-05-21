<?php
// Inicio y control de la sesión
		
$secure = true;
//mejor en config.php Lo ideal sería true para trabajar con https
$httponly = true;
// Obliga a la sesión a utilizar solo cookies.
// Habilitar este ajuste previene ataques que impican pasar el id de sesión en la URL.
if (ini_set('session.use_only_cookies', 1) === FALSE) {
    $action = "error";
    $error = "No puedo iniciar una sesion segura (ini_set)";
}
// Obtener los parámetros de la cookie de sesión
$cookieParams = session_get_cookie_params();
//ruta pedida tiene el mismo servidor $cookieParams["path"]
$path = "/";
$samesite = 'strict';
session_set_cookie_params([
    'lifetime' => $cookieParams["lifetime"], 
    'path' => $path, 
    'domain' => $_SERVER['HTTP_HOST'], 
    'secure' => $secure, 
    'httponly' => $httponly,
    'samesite' => $samesite
]);
//Marca la cookie como accesible sólo a través del protocolo HTTP.


session_start();
?>