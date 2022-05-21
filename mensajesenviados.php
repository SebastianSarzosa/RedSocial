<?php include('conexion.php'); ?>
<?php include('sesion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MensajesEnviados</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header6">
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto">Mensajes</h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="inicio.php"> Inicio </a>
                <a class="navegacion__enlace" href="nuevomensaje.php"> Redactar un Mensaje </a>
                <a class="navegacion__enlace" href="mensajesrecibidos.php"> Mensajes Recibidos </a>
            </nav>
        </div>
    </header>
    <br>
    <div class="contenedor">
        <section class="registro">
            <h2 class="registro__titulo">Mensajes Enviados</h2>
            <?php

                $consultamensajesenviados = $conn->query("SELECT * FROM usuarios");
                $contador = $consultamensajesenviados->rowcount();
                if ($contador > 0){ 
                    while($datosamigos = $consultamensajesenviados->fetch()){   
                        $destinatario = $datosamigos['id_usuario'];
                        $mensajes = $conn->query("SELECT id_usuario, id_destinatario, 
                        texto_mensaje, archivo_adjunto, fecha_mensaje FROM mensajes 
                        WHERE id_usuario = $session_id AND id_destinatario = $destinatario");
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
                        <div>
                            <input class="boton" type="submit" value="Eliminar Mensaje">
                        </div>
                    </div>
                </fieldset>
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