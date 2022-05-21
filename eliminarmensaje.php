<?php

include('conexion.php');
include('sesion.php');
//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

$eliminandoamigos = $conn -> prepare("DELETE FROM mensajes WHERE id_usuario = :id_usuario 
AND id_destinatario = :id_destinatario AND texto_mensaje = :texto_mensaje AND fecha_mensaje = :fecha_mensaje
/*OR id_usuario = :id_amigo_usuario 
AND id_amigo_usuario = :id_usuario*/");
$eliminandoamigos -> bindParam(':id_usuario', $session_id);
$eliminandoamigos -> bindParam(':id_destinatario', $_POST['id_destinatario']);
$eliminandoamigos -> bindParam(':texto_mensaje', $_POST['mensaje']);
$eliminandoamigos -> bindParam(':fecha_mensaje', $_POST['fechaenvio']);


if ($eliminandoamigos->execute()) {
    echo "<script> alert('Se elimino el mensaje de manera satisfactoria'); window.location = 'mensajesenviados.php'; </script>";
} else {
    echo "<script> alert('Disculpe, el mensaje no se ha podido eliminar'); window.location = 'mensajesenviados.php'; </script>";
}

?>