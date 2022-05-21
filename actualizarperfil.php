<?php

include('conexion.php');
include('sesion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//con esto ya llama la limpieza de datos?
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

$Actualizarstmt = $conn->prepare("UPDATE usuarios SET nombres = :nombres, apellidos = :apellidos,
correo = :correo, fecha_nacimiento = :fecha_nacimiento, cedula = :cedula, cantidad_hijos = :cantidad_hijos,
estado_civil = :estado_civil WHERE id_usuario = :id_usuario");
$Actualizarstmt -> bindParam(':id_usuario', $_POST['id_usuario']);
$Actualizarstmt -> bindParam(':nombres', $_POST['nombres']);
$Actualizarstmt -> bindParam(':apellidos', $_POST['apellidos']);
$Actualizarstmt -> bindParam(':correo', $_POST['correo']);
$Actualizarstmt -> bindParam(':fecha_nacimiento', $_POST['fecha_nacimiento']);
$Actualizarstmt -> bindParam(':cedula', $_POST['cedula']);
$Actualizarstmt -> bindParam(':cantidad_hijos', $_POST['cantidad_hijos']);
$Actualizarstmt -> bindParam(':estado_civil', $_POST['estado_civil']);

if ($Actualizarstmt->execute()) {
    echo "<script> alert('Actualización satisfactoria, Datos actualizados'); window.location = 'inicio.php'; </script>";
} else {
    echo "<script> alert('Disculpe, el usuario no se ha podido actualizar'); window.location = 'inicio.php'; </script>";
}

?>