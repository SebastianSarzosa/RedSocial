<?php
include('conexion.php');
include('sesion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['boton'])) {
    $nombre = $_POST['publicacion'];

    // Comprobación de que se ha enviado una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen']['name'];
        $tipo = $_FILES['imagen']['type'];
        $temp = $_FILES['imagen']['tmp_name'];

        // Comprobar el tipo de archivo
        if (!(strpos($tipo, 'gif') || strpos($tipo, 'jpeg') || strpos($tipo, 'webp') || strpos($tipo, 'png'))) {
            $_SESSION['mensaje'] = 'Solo se permiten archivos jpeg, gif, webp, png';
            $_SESSION['tipo'] = 'danger';
            header('location:./inicio.php');
            exit;
        }

        // Insertar datos en la base de datos usando sentencias preparadas
            $sql = "INSERT INTO portada (descripcion_port, fkid_usuario,estado_port	) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(2, $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(1, $session_id, PDO::PARAM_INT);
            $stmt->bindParam(3, $privado, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Mover la imagen al directorio de destino
            move_uploaded_file($temp, 'imagenes/' . $imagen);
            $_SESSION['mensaje'] = 'Artículo creado exitosamente';
            $_SESSION['tipo'] = 'success';
            header('location:./inicio.php');
            exit;
        } else {
            $_SESSION['mensaje'] = 'Ocurrió un error en el servidor';
            $_SESSION['tipo'] = 'danger';
        }
    } else {
        $_SESSION['mensaje'] = 'No se ha seleccionado una imagen o ha ocurrido un error durante la carga.';
        $_SESSION['tipo'] = 'danger';
        header('location:./inicio.php');
        exit;
    }
}
?>
