<?php

include('conexion.php'); 
include('sesion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);


$agregaamigo = $conn -> prepare("INSERT INTO amistades SET id_usuario = :id_usuario, 
id_amigo_usuario = :id_amigo_usuario");

$agregaamigo -> bindParam(':id_amigo_usuario', $_POST['id_amigo']);
$agregaamigo -> bindParam(':id_usuario', $session_id);

if ($agregaamigo->execute()) {
    echo "<script> alert('Nuevo amistad generada de manera satisfactoria'); window.location = 'amigos.php'; </script>";
} else {
    echo "<script> alert('No se pudo agregar la amistad correctamente'); window.location = 'amigos.php'; </script>";
}

?>