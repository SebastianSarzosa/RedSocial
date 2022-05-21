<?php

include('conexion.php');
include('sesion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();

$_POST = LimpiarEntradas($_POST);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RectarMensaje</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header6">
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto">Enviar Mensajes</h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="inicio.php"> Inicio </a>
                <a class="navegacion__enlace" href="mensajesenviados.php"> Mensajes Enviados </a>
                <a class="navegacion__enlace" href="mensajesrecibidos.php"> Mensajes Recibidos </a>
            </nav>
        </div>
    </header>
    <div class="contenedor">
        <section class="registro">
            <h2 class="registro__titulo">Enviar Mensaje</h2>
            <form class="formulario" action="enviarmensaje.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <!-- fieldset es para agrupar datos que estan dentro de un mismo formulario -->
                <fieldset>
                    <!-- legend es como un titulo para un grupo de datos -->
                    <legend>Ingrese Correctamente los Datos para Enviar el Mensaje</legend>
                    <div>
                        <div class="campos">
                            <label for="input01">Destinatario: </label>
                            <select class="estiloinput seleccionar" name="idamigo">
                                <option disabled selected>Seleccione una opción</option>
                                <?php
                                    $amigos = $conn->query("SELECT amistades.id_relacion_amistad, 
                                    usuarios.id_usuario, usuarios.nombres, usuarios.apellidos, usuarios.foto_perfil
                                    FROM amistades, usuarios WHERE amistades.id_amigo_usuario = '$session_id'
                                     AND usuarios.id_usuario = amistades.id_usuario OR 
                                    amistades.id_usuario = '$session_id' AND 
                                    usuarios.id_usuario = amistades.id_amigo_usuario");
                                    while ($mostraramiguis = $amigos -> fetch()) {
                                        $nombrecompleto = $mostraramiguis['nombres']." ".$mostraramiguis['apellidos'];
                                        $imagenamigo = $mostraramiguis['foto_perfil'];
                                        $idamigo = $mostraramiguis['id_usuario'];

                                ?>
                                <option value="<?php echo $idamigo; ?>"><?php echo $nombrecompleto; ?></option>
								<?php } ?>
                            </select>
                        </div>
                        <div class="campos">
                            <label for="input02">Mensaje: </label>
                            <input class="inputEstilos" type="text" name="mensaje" placeholder="Tu Mensaje" pattern="[a-zA-Z0-9ñÑ .,@?¡!¿-*/+áéíóúÁÉÍÓÚ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Archivo Adjunto: </label>
                            <input class="inputEstilos campofile" type="file" name="image" pattern="[a-zA-Z0-9ñÑ .,@]+">
                        </div>
                        <div>
                            <input class="boton" type="submit" value="nuevomensaje">
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </div>
    <br>
    <footer>
    <div class="contenedor">
        <div class="descripcion__titulo">
            <p class="descripcion__texto">Hecho por Juan Pablo</p>      
        </div>
    </div>
    </footer>
    <br>
</body>
</html>