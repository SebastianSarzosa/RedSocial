<?php

include('conexion.php');
include('sesion.php'); 
//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

if(isset($_POST['eliminar'])){
    $eliminararticulo = $conn->prepare ("DELETE FROM `articulos` WHERE id_articulo = :id_articulo");
    $eliminararticulo -> bindParam(':id_articulo', $_POST['id_articulo']);
    if ($eliminararticulo->execute()) {
        echo "<script> alert('Se elimino de manera satisfactoria la publicación'); window.location = 'todosarticulos.php'; </script>";
    } else {
        echo "<script> alert('Disculpe, el articulo no se ha podido eliminar'); window.location = 'todosarticulos.php'; </script>";
    }
}

if(isset($_POST['cambio'])){
    $cambioarticulo = $conn -> prepare ("UPDATE articulos SET articulo_privado = :articulo_privado WHERE id_articulo = :id_articulo");
    $cambio = "off";
    $cambioarticulo -> bindParam(':articulo_privado', $cambio);
    $cambioarticulo -> bindParam(':id_articulo', $_POST['id_articulo']);

    if ($cambioarticulo -> execute()) {
        echo "<script> alert('Se cambio de manera satisfactoria la publicación'); window.location = 'todosarticulos.php'; </script>";
    } else {
        echo "<script> alert('Disculpe, el articulo no se ha podido cambiar'); window.location = 'todosarticulos.php'; </script>";
    }
}

if(isset($_POST['cambiecito'])){
    $cambioarticulo2 = $conn -> prepare ("UPDATE articulos SET articulo_privado = :articulo_privado WHERE id_articulo = :id_articulo");
    $cambio = "on";
    $cambioarticulo2 -> bindParam(':articulo_privado', $cambio);
    $cambioarticulo2 -> bindParam(':id_articulo', $_POST['id_articulo']);

    if ($cambioarticulo2 -> execute()) {
        echo "<script> alert('Se cambio de manera satisfactoria la publicación'); window.location = 'todosarticulos.php'; </script>";
    } else {
        echo "<script> alert('Disculpe, el articulo no se ha podido cambiar'); window.location = 'todosarticulos.php'; </script>";
    }
}


?>