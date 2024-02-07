<?php
// Incluye tu archivo de conexión a la base de datos
include('conexion.php');

// Verifica si se recibió el ID del comentario y el nuevo contenido
if (isset($_POST['id_comentario']) && isset($_POST['nuevo_contenido'])) {
    $id_comentario = $_POST['id_comentario'];
    $nuevo_contenido = $_POST['nuevo_contenido'];

    // Consulta SQL para actualizar el contenido del comentario en la base de datos
    $sql = "UPDATE comentarios SET contenido = :nuevo_contenido WHERE id_comentario = :id_comentario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nuevo_contenido', $nuevo_contenido);
    $stmt->bindParam(':id_comentario', $id_comentario);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Envía una respuesta HTTP 200 OK si la actualización fue exitosa
        http_response_code(200);
        echo "Comentario actualizado correctamente.";
    } else {
        // Envía una respuesta de error si la actualización falló
        http_response_code(500);
        echo "Error al intentar actualizar el comentario.";
    }
} else {
    // Envía una respuesta de error si no se proporcionó un ID de comentario y nuevo contenido válido
    http_response_code(400);
    echo "ID de comentario o nuevo contenido no válido.";
}
?>
