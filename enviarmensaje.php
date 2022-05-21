<?php

include('conexion.php');
include('sesion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);
    
if (isset($_FILES['image']) && $_FILES['image'] != "") {

    $enviomensaje = $conn -> prepare("INSERT INTO mensajes SET id_usuario = :id_usuario,
    id_destinatario = :id_destinatario, texto_mensaje = :texto_mensaje, archivo_adjunto = :archivo_adjunto,
    fecha_mensaje = NOW()");

    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];
    $imageNameCmps = explode(".", $image_name);
    $imageExtension = strtolower(end($imageNameCmps));//asegura que el nombre sea un archivo aceptable
    $newFileName = md5(time() . $image_name) . '.' . $imageExtension; //evalua el nombre
    $allowedimageExtensions = array('jpg', 'gif', 'png', 'jpeg'); // solo permite estas entradas de imagenes o extensiones
    if (in_array($imageExtension, $allowedimageExtensions)) {

        // directory in which the uploaded file will be moved
        $uploadFileDir = 'archivoscorruptos/'; // mueve el archivo corrupto aqui
        if (!file_exists($uploadFileDir)) {
            mkdir($uploadFileDir);
        }
        move_uploaded_file($_FILES["image"]["tmp_name"], "archivos/" . $_FILES["image"]["name"]);
        $location = "archivos/" . $_FILES["image"]["name"];
        $enviomensaje -> bindParam(':archivo_adjunto', $location);
        $enviomensaje -> bindParam(':id_usuario', $session_id);
        $enviomensaje -> bindParam(':id_destinatario', $_POST['idamigo']);
        $enviomensaje -> bindParam(':texto_mensaje', $_POST['mensaje']);


        try {
    
            $enviomensaje->execute();
            echo "<script> alert('Mensaje enviado'); window.location = 'mensajesenviados.php'; </script>";
        
        } catch (\Throwable $th) {
            $e->getMessage();
            echo "<script> alert('Disculpe, el mensaje no se ha podido enviar'); window.location = 'mensajesenviados.php'; </script>";
            die();
        }
/*
        if ($enviomensaje->execute()) {
            echo "<script> alert('Mensaje enviado'); window.location = 'mensajesenviados.php'; </script>";
        } else {
            echo "<script> alert('Disculpe, el mensaje no se ha podido enviar'); window.location = 'mensajesenviados.php'; </script>";
        }
        echo "<script> alert('Disculpe, el mensaje no se ha podido enviar'); window.location = 'mensajesenviados.php'; </script>";
*/
    }
    echo "<script> alert('Disculpe, el mensaje no se ha podido enviar'); window.location = 'mensajesenviados.php'; </script>";

} /*
    if (isset($_FILES['image']) && $_FILES['image'] == ""){
        $enviomensajesin = $conn -> prepare("INSERT INTO mensajes SET id_usuario = :id_usuario,
        id_destinatario = :id_destinatario, texto_mensaje = :texto_mensaje, fecha_mensaje = NOW()");

        $enviomensajesin -> bindParam(':id_usuario', $session_id);
        $enviomensajesin -> bindParam(':id_destinatario', $_POST['idamigo']);
        $enviomensajesin -> bindParam(':texto_mensaje', $_POST['mensaje']);

        if ($enviomensajesin->execute()) {
            echo "<script> alert('Mensaje enviado'); window.location = 'mensajesenviados.php'; </script>";
        } else {
            echo "<script> alert('Disculpe, el mensaje no se ha podido enviar'); window.location = 'mensajesenviados.php'; </script>";
        }
    }
*/

?>