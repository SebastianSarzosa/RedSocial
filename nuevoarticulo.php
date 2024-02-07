    <?php
    include('conexion.php');
    include('sesion.php');
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Artículo</title>
        <link rel="stylesheet" href="css/normalize.css"> <!-- Normalice.css? -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
        <style>
            /* Estilos para la página */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f3f3f3; /* Cambio del color de fondo */
            }
            .formulario__articulo--nuevo {
                background-color: #fff;
                border-radius: 5px;
                padding: 20px;
                margin-bottom: 20px;
                margin-top:10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                top: 95px;
                position: absolute;
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
        </style>
    </head>
    <body>
        <?php 
            include("menu_bar.php");
        ?>
        <div class="contenedor" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
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
                                    ?> <img class="imageninicio" src="fotosperfil/<?php echo $image; ?>" style="width: 300px;"> <?php
                                } else {
                                    ?> <img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg" style="width: 300px;"> <?php
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
