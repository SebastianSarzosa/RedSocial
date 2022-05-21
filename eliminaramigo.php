<?php

include('conexion.php');
include('sesion.php');
//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

$eliminandoamigos = $conn -> prepare("DELETE FROM amistades WHERE id_usuario = :id_usuario 
AND id_amigo_usuario = :id_amigo_usuario OR id_usuario = :id_amigo_usuario 
AND id_amigo_usuario = :id_usuario");
$eliminandoamigos -> bindParam(':id_usuario', $session_id);
$eliminandoamigos -> bindParam(':id_amigo_usuario', $_POST['id_amigo']);


if ($eliminandoamigos->execute()) {
    echo "<script> alert('Se elimino la amistad de manera satisfactoria'); window.location = 'amigos.php'; </script>";
} else {
    echo "<script> alert('Disculpe, la amistad no se ha podido eliminar'); window.location = 'amigos.php'; </script>";
}

?>