<?php include('conexion.php'); ?>
<?php include('sesion.php'); 
require_once 'funciones.php';
if (isset($_POST['btnAccion'])) {
    AntiCSRF();
}
GenerarAnctiCSRF();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <style>
        /* Estilos para la página */
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

        .campos {
            margin-bottom: 15px;
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
    </style>
</head>
<body>
    <?php 
        include("menu_bar.php");
    ?>
    <br>
    <div class="contenedor">
        <section class="registro">
            <center><h1 class="registro__titulo">Mensajes Recibidos</h1></center>
            <hr>
            <div class="controls">
                <div class="add">
                        <a href="nuevoarticulo.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-plus-fill" viewBox="0 0 16 16">
                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zM8.5 6v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0"/>
                            </svg>
                            <h3 style="display:inline;">Nuevo</h3>
                        </a>
                </div>
                <div class="add">
                        <a href="nuevoarticulo.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
                            <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z"/>
                        </svg>
                            <h3 style="display:inline;">Enviados</h3>
                        </a>
                </div>
            </div>
            <?php

                $consultamensajesenviados = $conn->query("SELECT * FROM usuarios");
                $contador = $consultamensajesenviados->rowcount();
                if ($contador > 0){ 
                    while($datosamigos = $consultamensajesenviados->fetch()){   
                        $destinatario = $datosamigos['id_usuario'];
                        $mensajes = $conn->query("SELECT id_usuario, id_destinatario, 
                        texto_mensaje, archivo_adjunto, fecha_mensaje FROM mensajes 
                        WHERE id_usuario = '$destinatario' AND id_destinatario = '$session_id'");
                        while($mensajesamigos = $mensajes->fetch()){ 
                            if($mensajesamigos != null){
            ?>
            <form class="formulariomensajitos" action="eliminarmensaje.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <!-- fieldset es para agrupar datos que estan dentro de un mismo formulario -->
                <fieldset>
                    <div>
                        <div class="campos">
                            <input class="inputEstilos" type="hidden" name="id_destinatario" value="<?php echo $destinatario; ?>" placeholder="Tu Mensaje" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Destinatario: </label>
                            <input class="inputEstilos" type="text" name="destinatario" value="<?php echo $datosamigos['nombres']." ".$datosamigos['apellidos']; ?>" placeholder="Tu Mensaje" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Mensaje: </label>
                            <input class="inputEstilos" type="text" name="mensaje" value="<?php echo $mensajesamigos['texto_mensaje']; ?>" placeholder="Tu Mensaje" pattern="[a-zA-Z0-9ñÑ .,@?¡!¿-*/+]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Archivo Adjunto: </label>
                            <center><img class="imageninicio" src="<?php echo $mensajesamigos['archivo_adjunto']; ?>" ></center>
                        </div>
                        <div class="campos">
                            <label for="input02">Fecha en que se Envio: </label>
                            <input class="inputEstilos"  name="fechaenvio" value="<?php echo $mensajesamigos['fecha_mensaje']; ?>" placeholder="Tu Mensaje" pattern="[a-zA-Z0-9ñÑ -:]+" required>
                        </div>
                        <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">
                        <div>
                            <input class="boton" type="submit" value="Eliminar Mensaje">
                        </div>
                    </div>
                </fieldset>
                <br>
                
            </form>
            <br>
            <?php
                            }
                        }
                    }
                }else{
                    echo '1';
                }

            ?>
        </section>
        <br><br>
    </div>
    <br>
</body>
</html>
