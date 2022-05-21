<?php

include('conexion.php');
include('sesion.php');

//se llama el metodo para mostrar los errores
MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

$consultadatospersonales = $conn->query("select * from usuarios where id_usuario = '$session_id'");
$datosusuario = $consultadatospersonales->fetch();
$id = $datosusuario['id_usuario'];

if(isset($_POST['boton'])){
    $Insertarstmt = $conn -> prepare("INSERT INTO articulos SET id_usuario=:id_usuario, texto_articulo=:texto_articulo,
    articulo_privado=:articulo_privado, fecha_publicacion= NOW()");

    $Insertarstmt -> bindParam(':id_usuario', $session_id);
    $Insertarstmt -> bindParam(':texto_articulo', $_POST['publicacion']);
    if(isset($_POST['privado'])){
        $Insertarstmt -> bindParam(':articulo_privado', $_POST['privado']);
    }else{
        $articulo_privado = "off";
        $Insertarstmt -> bindParam(':articulo_privado', $articulo_privado);
    }
    
    
        
} 
if ($Insertarstmt->execute()) {
    echo "<script> alert('Publicación realizada'); window.location = 'todosarticulos.php'; </script>";
} else {
    echo "<script> alert('No se pudo publicar, vuelva a intentarlo'); window.location = 'todosarticulos.php'; </script>";
}

?>