<?php

include('conexion.php');
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
    <title>Registro</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header2">
        <div class="contenedor">
            <div class="contenedor__titulo">
                    <h1 class="no-margin centrar-texto">Registrarse</h1>
            </div>
        </div>
        <nav class="navegacion">
            <a class="navegacion__enlace" href="index.php"> Inicio </a>
            <a class="navegacion__enlace" href="ingreso.php"> Ingresar </a>
        </nav>
    </header>
    <div class="contenedor">
        <section class="registro">
            <h2 class="registro__titulo">Zona de Registro</h2>
            <form class="formulario" action="registrandose.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <!-- fieldset es para agrupar datos que estan dentro de un mismo formulario -->
                <fieldset>
                    <!-- legend es como un titulo para un grupo de datos -->
                    <legend>Llene Todos los Datos para registrar un usuario</legend>
                    <div>
                        <div class="campos">
                            <label for="input01">Nombres: </label>
                            <input class="inputEstilos" name="nombres" type="text" placeholder="Tus nombres" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Apellidos: </label>
                            <input class="inputEstilos" name="apellidos" type="text" placeholder="Tus apellidos" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input03">Correo: </label>
                            <input class="inputEstilos" name="correo" type="email" placeholder="Tu Correo" pattern="[a-zA-Z0-9ñÑ @.]+" required>
                        </div>
                        <div class="campos">
                            <label for="input04">Fecha de Nacimiento: </label>
                            <input class="inputEstilos" name="fecha_nacimiento" type="date" placeholder="Tu Fecha de Nacimiento" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input05">Cédula: </label>
                            <input class="inputEstilos" name="cedula" type="number" placeholder="Tu Cedula" min="0" maxlength="11" pattern="[0-9]+" required>
                        </div>
                        <div class="campos">
                            <label for="input06">Cantidad de Hijos: </label>
                            <input class="inputEstilos" name="cantidad_hijos" type="number" placeholder="Tu Cantidad de Hijos" min="0" maxlength="3" pattern="[0-9]+" required>
                        </div>
                        <div class="campos">
                            <label for="input07">Estado civil: </label>
                            <select class="estiloinput seleccionar" name="estado_civil" type="text" placeholder="Tu Estado civil" pattern="[a-zA-Z0-9ñÑ]+" required>
                                <option disabled selected>Seleccione una opción</option>
                                <option value="Soltero">Soltero/a</option>
                                <option value="Casado">Casado/a</option>
                                <option value="Viudo">Viudo/a</option>
                            </select>
                        </div>
                        <div class="campos">
                            <label for="input08">Usuario: </label>
                            <input class="inputEstilos" name="nombre_usuario" type="text" placeholder="Tu Usuario" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input09">Clave: </label>
                            <input class="inputEstilos" name="clave" type="password" placeholder="Tu Clave" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input10">Confirmar Clave: </label>
                            <input class="inputEstilos" name="confirmarclave" type="password" placeholder="Confirmar Clave" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        
                        <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">
                        
                        <div>
                            <input class="boton" type="submit" value="Registrar">
                        </div>
                        <div>
                            <center>
                            <p class="campos">
                                ¿Ya tienes cuenta? <br>
							<a href="ingreso.php">Ingresa</a>
						    </p>
                            </center>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </div>
    <footer>
    <div class="contenedor">
        <div class="descripcion__titulo">
            <p class="descripcion__texto">Hecho por Juan Pablo</p>      
        </div>
    </div>
    </footer>
</body>
</html>