<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialUTC+</title>
    <style>
    /* Estilos para la página */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .main {
        display: flex;
        justify-content: center; /* Cambio realizado aquí para centrar horizontalmente */
        flex-wrap: wrap;
    }

        .publicacion {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            width: calc(90.33% - 20px);
            box-sizing: border-box;
        }

        .publicacion img {
            max-width: 100%;
            display: block;
            margin: 0 auto 10px;
        }

        .reacciones {
            margin-top: 10px;
        }

        .reaccion {
            color: #333;
            text-decoration: none;
            margin-right: 10px;
        }

        .comentarios {
            margin-top: 10px;
        }

        .comentario {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 5px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .publicaciones-section{
            margin:auto;
            width: 600px;  
        }
        .main{
            top:95px;
            position: relative;
        }
    </style>
</head>
<body>
    <?php include("menu_bar.php");?>
    
    <div class="contenedor">
        <main class="main">
            <section class="publicaciones-section">
                <!-- Aquí tu PHP para mostrar las publicaciones -->
                <?php
                // Aquí incluye tu archivo de conexión a la base de datos
                include('conexion.php');
                
                // Realiza la consulta para obtener las publicaciones
                $consultaArticulos = $conn->query("SELECT articulos.*, usuarios.nombres, usuarios.apellidos 
                                                   FROM articulos 
                                                   INNER JOIN usuarios ON articulos.id_usuario = usuarios.id_usuario 
                                                   ORDER BY articulos.fecha_publicacion DESC");

                // Comprueba si hay artículos
                if ($consultaArticulos->rowCount() > 0) {
                    while ($articulo = $consultaArticulos->fetch()) {
                ?>
                        <div class="publicacion" id="publicacion-<?php echo $articulo['id_articulo']; ?>">
                            <div class="publicacion-info">
                                <h3><?php echo $articulo['nombres'] . ' ' . $articulo['apellidos']; ?></h3>
                                <span class="fecha-publicacion">Fecha de publicación: <?php echo $articulo['fecha_publicacion']; ?></span>
                            </div>
                            <?php if (isset($articulo['texto_articulo'])) : ?>
                                <p><?php echo $articulo['texto_articulo']; ?></p>
                            <?php else : ?>
                                <p>Contenido no disponible.</p>
                            <?php endif; ?>
                            <?php
                            if (!empty($articulo['imagen_perfil'])) {
                                $imagenURL = 'data:image/jpeg;base64,' . base64_encode($articulo['imagen_perfil']);
                            ?>
                            <?php } ?>
                            <img src="imagenes/<?php echo $articulo['imagen_perfil']; ?>" alt="Imagen del artículo ">

                            <div class="reacciones">
                                <!-- Enlace para dar "Me gusta" -->
                                <a href="#" class="reaccion" onclick="darLike(<?php echo $articulo['id_articulo']; ?>)">Me gusta</a>
                                <!-- Enlace para mostrar/ocultar los comentarios -->
                                <a href="#" class="reaccion" onclick="mostrarComentarios(<?php echo $articulo['id_articulo']; ?>)">Comentar</a>
                            </div>

                            <!-- Contenedor de comentarios -->
                            <div class="comentarios" id="comentarios-<?php echo $articulo['id_articulo']; ?>" style="display: none;">
                                <!-- Aquí se mostrarán los comentarios -->
                                <?php
                                // Consulta los comentarios para este artículo
                                $consultaComentarios = $conn->query("SELECT * FROM comentarios WHERE id_articulo = " . $articulo['id_articulo']);
                                // Comprueba si hay comentarios
                                if ($consultaComentarios->rowCount() > 0) {
                                    while ($comentario = $consultaComentarios->fetch()) {
                                        echo '<div class="comentario" id="comentario-' . $comentario['id_comentario'] . '">';
                                        echo '<p>' . $comentario['contenido'] . '</p>';
                                        // Botones para editar y eliminar comentario
                                        echo '<button onclick="eliminarComentario(' . $comentario['id_comentario'] . ')">Eliminar</button>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<div class="comentario">No hay comentarios.</div>';
                                }
                                ?>
                            </div>

                            <!-- Formulario para agregar comentarios -->
                            <div class="agregar-comentario" style="display: none;">
                                <form method="post">
                                    <input type="hidden" name="id_articulo" value="<?php echo $articulo['id_articulo']; ?>">    
                                    <textarea name="contenido" placeholder="Escribe tu comentario"></textarea>
                                    <button type="submit" name="submit">Enviar</button>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No hay artículos publicados.</p>";
                }
                ?>

                <!-- PHP para guardar comentarios -->
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                    // Verifica si se recibió el formulario de comentario
                    if (isset($_POST['id_articulo']) && isset($_POST['contenido'])) {
                        $id_articulo = $_POST['id_articulo'];
                        $contenido = $_POST['contenido'];
                        
                        // Inserta el comentario en la base de datos
                        $sql = "INSERT INTO comentarios (contenido, id_articulo) VALUES (:contenido, :id_articulo)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':contenido', $contenido);
                        $stmt->bindParam(':id_articulo', $id_articulo);
                        
                        if ($stmt->execute()) {
                            // Comentario guardado exitosamente
                            echo "<script>alert('Comentario guardado exitosamente.');</script>";
                        } else {
                            // Error al guardar el comentario
                            echo "<script>alert('Error al guardar el comentario.');</script>";
                        }
                    }
                }
                ?>
            </section>
        </main>
    </div>
    <script>
        function darLike(idArticulo) {
            // Aquí puedes realizar una solicitud AJAX para dar like al artículo con el ID correspondiente
            // Por ejemplo, puedes usar Fetch API o jQuery.ajax()
            // Después de dar like, actualiza la interfaz de usuario para reflejar el cambio
            alert('Has dado like a la publicacion ' + idArticulo);
        }

        function mostrarComentarios(idArticulo) {
            var comentarios = document.getElementById('comentarios-' + idArticulo);
            var formulario = document.querySelector('#publicacion-' + idArticulo + ' .agregar-comentario');

            if (comentarios.style.display === 'none') {
                comentarios.style.display = 'block';
                formulario.style.display = 'block';
            } else {
                comentarios.style.display = 'none';
                formulario.style.display = 'none';
            }
        }

        function editarComentario(idComentario) {
            // Aquí puedes implementar la lógica para editar el comentario
            alert('Editar comentario con ID ' + idComentario);
        }

        function eliminarComentario(idComentario) {
            // Aquí puedes realizar una solicitud AJAX para eliminar el comentario con el ID correspondiente
            var confirmar = confirm('¿Estás seguro de que quieres eliminar este comentario?');
            if (confirmar) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'eliminar_comentario.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Si la solicitud fue exitosa, elimina el comentario del DOM
                        document.getElementById('comentario-' + idComentario).remove();
                    } else {
                        // Maneja el error si la solicitud no fue exitosa
                        alert('Error al eliminar el comentario.');
                    }
                };
                xhr.send('id_comentario=' + idComentario);
            }
        }

        function mostrarFormEditar(idComentario) {
            var formularioEditar = document.getElementById('form-editar-' + idComentario);
            formularioEditar.style.display = 'block';
        }
    </script>
    <script>
    window.addEventListener("scroll", function(){
        var header = document.querySelector(".header");
        header.classList.toggle("abajo",this.window.scrollY>0);
    })
</script>
</body>
</html>
