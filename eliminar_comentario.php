<?php
// Incluye tu archivo de conexión a la base de datos
include('conexion.php');

// Verifica si se recibió el ID del comentario a eliminar
if (isset($_POST['id_comentario'])) {
    $id_comentario = $_POST['id_comentario'];

    // Consulta SQL para eliminar el comentario de la base de datos
    $sql = "DELETE FROM comentarios WHERE id_comentario = :id_comentario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_comentario', $id_comentario);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Envía una respuesta HTTP 200 OK si la eliminación fue exitosa
        http_response_code(200);
        echo "Comentario eliminado correctamente.";
    } else {
        // Envía una respuesta de error si la eliminación falló
        http_response_code(500);
        echo "Error al intentar eliminar el comentario.";
    }
} else {
    // Envía una respuesta de error si no se proporcionó un ID de comentario válido
    http_response_code(400);
    echo "ID de comentario no válido.";
}
?>
