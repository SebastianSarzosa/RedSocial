    <?php
    include('conexion.php');
    include('sesion.php');

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $publicacion = mysqli_real_escape_string($conn, $_POST['publicacion']); // Evita inyección SQL
        $privado = isset($_POST['privado']) ? 1 : 0; // Si está marcado, establece 1, de lo contrario 0
        
        // Procesar la imagen subida
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_tmp = $_FILES['imagen']['tmp_name'];
            $imagen_contenido = addslashes(file_get_contents($imagen_tmp)); // Convertir la imagen a datos binarios para almacenarla en la base de datos
        } else {
            $imagen_contenido = null; // Si no se ha subido ninguna imagen
        }

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO articulos (publicacion, privado, foto_publicacion) VALUES ('$publicacion', '$privado', '$imagen_contenido')";
        if ($conn->query($sql) === TRUE) {
            echo "Artículo creado exitosamente";    
        } else {
            echo "Error al crear el artículo: " . $conn->error;
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Artículo</title>
        <link rel="stylesheet" href="css/normalize.css"> <!-- Normalice.css? -->
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
        <style>
            /* Estilos para la página */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f3f3f3; /* Cambio del color de fondo */
            }

            .contenedor {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .formulario__articulo--nuevo {
                background-color: #fff;
                border-radius: 5px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .inputEstilosarticulos {
                width: calc(100% - 20px); /* Se agrega el padding al width */
                padding: 10px;
                margin-top: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .cajita {
                margin-top: 10px;
            }

            .boton {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                background-color: #4CAF50;
                color: white;
            }

            .imagen-preview {
                max-width: 100%; /* La imagen ocupa todo el ancho del contenedor */
                height: auto; /* Se ajusta la altura automáticamente */
                margin-top: 10px;
                display: none; /* Oculta la imagen previa por defecto */
            }

            /* Estilos de la barra de navegación */
            .header5 {
                background-color: transparent; /* Se elimina el fondo azul */
                padding: 10px 0;
            }

            .contenedor__titulo2 {
                margin: 0;
            }

            .navegacion {
                text-align: right;
            }

            .navegacion__enlace {
                color: #333; /* Se cambia el color de los enlaces */
                text-decoration: none;
                margin-left: 20px;
            }

            /* Estilos del pie de página */
            footer {
                background-color: #333;
                color: #fff;
                padding: 10px 0;
                text-align: center;
                position: fixed;
                bottom: 0;
                width: 100%;
            }
            img{
                width: 300px;
            }
        </style>
    </head>
    <body>
        <header class="header5">
            <div class="contenedor">
                <div class="contenedor__titulo2">
                    <h1 class="no-margin centrar-texto">Crear un Artículo</h1>
                </div>
                <nav class="navegacion">
                    <a class="navegacion__enlace" href="inicio.php">Inicio</a>
                    <a class="navegacion__enlace" href="todosarticulos.php">Todas las publicaciones</a>
                    <a class="navegacion__enlace" href="misarticulos.php">Mis Publicaciones</a>
                </nav>
            </div>
        </header>
        <div class="contenedor">
            <?php
            $consultadatospersonales = $conn->query("SELECT * FROM usuarios WHERE id_usuario = '$session_id'");
            $datosusuario = $consultadatospersonales->fetch();
            $id = $datosusuario['id_usuario'];
            ?>
            <form class="formulario__articulo--nuevo" action="insertandoarticulo.php" method="POST" autocomplete="on" enctype="multipart/form-data"> 
                <div class="contenedordatosautor"> 
                        <aside class="sidebar">
                            <div class="campos">
                                <label class="descripcion__texto" for="img">Foto de autor: </label>
                                <?php if($datosusuario['foto_perfil'] != null){
                                    ?> <img class="imageninicio" src="<?php echo $image; ?>"> <?php
                                } else {
                                    ?> <img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg"> <?php
                                } ?>
                            </div>
                        </aside>
                        <div class="camposdaticos">
                            <div>
                                <label class="descripcion__texto" for="input01">Nombre Autor: </label>
                                <p class="datosusuario"><?php echo $datosusuario['nombres']." ".$datosusuario['apellidos']; ?></p>
                            </div>
                        </div>
                </div>
                <hr>
                <div>
                    <center><h3>Proceso de Publicación</h3></center>
                    <p class="titulopublicacion">Texto a Publicar:</p>
                    <input class="inputEstilosarticulos" name="publicacion" type="text" placeholder="Qué desea publicar" pattern="[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,@?¿!/*-+]+" required> 
                </div>
                <br>
                <div>
                    <label class="descripcion__texto">Privado</label>
                    <input class="cajita" name="privado" type="checkbox">
                    <br>
                    <hr>
                    <p class="descripcion__texto">Seleccione la opción privado si desea que sea privado (solo para el autor), y no seleccione nada si desea que sea público (para que lo puedan ver todos).</p>
                </div>
                <div>
                    <input type="file" name="imagen" accept="image/*">
                    <br>
                    <img class="imagen-preview" id="imagen-preview" src="#" alt="Vista previa de la imagen">
                </div>
                <br>
                <div>
                    <input class="boton" name="boton" type="submit" value="Publicar">
                </div>
            </form>
        </div>
        <br>
        <footer>
        </footer>
        <br><br>
        <script>
            // Vista previa de la imagen seleccionada
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('imagen-preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
            document.querySelector('input[type="file"]').addEventListener('change', previewImage);
        </script>
    </body>
    </html>
