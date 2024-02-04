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

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header6">
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto">Mensajes Recibidos</h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="inicio.php"> inicio </a>
                <a class="navegacion__enlace" href="mensajesenviados.php"> Mensajes Enviados </a>
                <a class="navegacion__enlace" href="nuevomensaje.php"> Redactar un Mensaje </a>
            </nav>
        </div>
    </header>
    <br>
    <div class="contenedor">
        <section class="registro">
            <h2 class="registro__titulo">Mensajes Recibidos</h2>
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
