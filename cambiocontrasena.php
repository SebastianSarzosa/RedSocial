<?php include('conexion.php'); ?>
<?php include('sesion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CambioContraseña</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header7">    
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto">Cambio Contraseña</h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace1" href="perfil.php"> perfil </a>
            </nav>
        </div>
    </header>
    <div class="contenedor">
        <section class="registro">
            <h2 class="registro__titulo">Cambio de Contraseña</h2>
            <form class="formulariocambiocon" action="actualizacioncontraseña.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <!-- fieldset es para agrupar datos que estan dentro de un mismo formulario -->
                <fieldset>
                    <!-- legend es como un titulo para un grupo de datos -->
                    <legend>Ingrese Correctamente la contraseña del usuario</legend>
                    <div>
                        <div class="campos">
                            <label for="input01">Contraseña Actual: </label>
                            <input class="inputEstilos" type="password" name="contraseñaactual" placeholder="Tu Contraseña Actual" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Contraseña Nueva: </label>
                            <input class="inputEstilos" type="password" name="contraseñanueva" placeholder="Tu Nueva Contraseña" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Confirmar Contraseña Nueva: </label>
                            <input class="inputEstilos" type="password" name="confirmarcontraseña" placeholder="Para Confirmar" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div>
                            <input class="boton" type="submit" value="Actualizar Contraseña">
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