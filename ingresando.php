<?php 

include('conexion.php');
include('sesionprueba.php');
//session_start();

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

//consulta select
$Seleccionastmt = $conn -> prepare ("SELECT * FROM usuarios where nombre_usuario = :nombre_usuario");

$Seleccionastmt -> bindParam (':nombre_usuario', $_POST['usuario']);
//$Seleccionastmt -> execute();

try {
    
    $Seleccionastmt -> execute();

} catch (\Throwable $th) {
    $e->getMessage();
    //echo "<script> alert('Disculpe, hay un error'); window.location = 'index.php'; </script>";
    die();
}

$datosusuario = $Seleccionastmt -> fetch();
if($datosusuario){
    if(password_verify($_POST['clave'], $datosusuario['clave'])){
        $_SESSION['id'] = $datosusuario['id_usuario'];
            if (isset($_SESSION['id'])) {
                header('location:inicio.php');
            }
    } else {
        //echo "<script> alert('Disculpe, la clave es incorrecta'); window.location = 'ingreso.php; </script>";
        header('location:ingreso.php');
    }
} else {
    //echo "<script> alert('Disculpe, el usuario es incorrecto'); window.location = 'ingreso.php'; </script>";
    header('location:ingreso.php');
}

?>