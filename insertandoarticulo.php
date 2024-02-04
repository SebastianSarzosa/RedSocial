<?php
include('conexion.php');
include('sesion.php');

if (isset($_POST['boton'])) {
    $nombre = $_POST['publicacion'];
    $imagen = $_FILES['imagen']['name'];
    $privado = isset($_POST['privado']) ? 1 : 0;

    if (isset($imagen) && $imagen != "") {
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

        if (!(strpos($tipo, 'gif') || strpos($tipo, 'jpeg') || strpos($tipo, 'webp') || strpos($tipo, 'png'))) {
            $_SESSION['mensaje'] = 'Solo se permiten archivos jpeg, gif, webp, png';
            $_SESSION['tipo'] = 'danger';
            header('location:../index.php');
        } else {
            // Insertar datos en la base de datos usando sentencias preparadas
            $sql = "INSERT INTO articulos (id_usuario, texto_articulo, articulo_privado, fecha_publicacion, imagen_perfil) VALUES (?, ?, ?, NOW(), ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $session_id, PDO::PARAM_INT);
            $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
            $stmt->bindParam(3, $privado, PDO::PARAM_INT);
            $stmt->bindParam(4, $imagen, PDO::PARAM_STR);

            if ($stmt->execute()) {
                move_uploaded_file($temp, 'imagenes/' . $imagen);
                $_SESSION['mensaje'] = 'Artículo creado exitosamente';
                $_SESSION['tipo'] = 'success';
                header('location:./inicio.php');
            } else {
                $_SESSION['mensaje'] = 'Ocurrió un error en el servidor';
                $_SESSION['tipo'] = 'danger';
            }
        }
    }
}
?>
