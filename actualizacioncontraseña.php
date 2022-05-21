<?php

include('conexion.php');
include('sesion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//con esto ya llama la limpieza de datos?
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

$consultadatospersonales = $conn->query("select * from usuarios where id_usuario = '$session_id'");
$datosusuario = $consultadatospersonales->fetch();
$id = $datosusuario['id_usuario'];

$contraseñaactual = $_POST['contraseñaactual'];
$contraseñanueva = $_POST['contraseñanueva'];
$confirmarcontraseña = $_POST['confirmarcontraseña'];

if(password_verify($contraseñaactual, $datosusuario['clave'])){

    if ($contraseñanueva == $confirmarcontraseña) {

        $Actualizarstmt = $conn->prepare("UPDATE usuarios SET clave = :clave WHERE id_usuario = '$id'");
        $clave = password_hash($_POST['contraseñanueva'], PASSWORD_BCRYPT);
	    $Actualizarstmt -> bindParam(':clave', $clave);

        if ($Actualizarstmt->execute()) {
            echo "<script> alert('Actualizacion de contraseña satisfactoria'); window.location = 'perfil.php'; </script>";
        } else {
            echo "<script> alert('Disculpe, el usuario no se ha podido crear'); window.location = 'perfil.php'; </script>";
        }

    } else {
        echo "<script> alert('Disculpe, la contraseña nueva no coincide con la confirmación'); window.location = 'perfil.php'; </script>";
    }
} else {
    echo "<script> alert('Disculpe, la contraseña es incorrecta'); window.location = 'perfil.php'; </script>";
}

?>