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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .contenedor {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header6 {
            background-color: #94c6d1;
            padding: 10px 0;
        }

        .contenedor__titulo2 {
            margin: 0;
        }

        .navegacion {
            text-align: right;
        }

        .navegacion__enlace {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }

        .navegacion__enlace--sesion {
            margin-left: 40px;
        }

        .registro {
            top: 90px;
            position: relative;
            margin-top: 20px;
        }

        .registro__titulo {
            margin: 0;
        }

        .inputEstilos {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .imageninicio {
            max-width: 100%;
        }

        .boton {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .add {
            padding: 20px 30px;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            background: #fff;
            transition: all ease-in-out 0.3s;
            width: 110px;
            margin-right: 10px;
        }
        .add a{
            color: #545454;
            text-decoration:none;
        }
        .add a:hover{
            color: #000;
        }
        .controls{
            display: flex;
        }
        .formulario{
            width: 600px;
            margin:20px auto;
            border-radius:10px;
            border: 1px solid #ccc;
            padding-top: 10px;

        }
        fieldset{
            border:none;
        }
        .campos{
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <?php 
        include("menu_bar.php");
    ?>
    <div class="contenedor">
        <section class="registro">
            <center><h1 class="registro__titulo">Nuevo Mensaje</h1></center>
            <hr>
            <div class="controls">
                <div class="add">
                    <a href="mensajesenviados.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
                        <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z"/>
                    </svg>
                        <h3 style="display:inline;">Enviados</h3>
                    </a>
                </div>
                <div class="add">
                        <a href="mensajesrecibidos.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z"/>
                                <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"/>
                            </svg>
                            <h3 style="display:inline;">Recibidos</h3>
                        </a>
                </div>
            </div>
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
</body>
</html>