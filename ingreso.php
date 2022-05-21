<?php

include('conexion.php');
//session_start();

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
    <title>Ingreso</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header3">
        <div class="contenedor">
            <div class="contenedor__titulo">
                <h1 class="no-margin centrar-texto">Ingresar</h1>
            </div>
        </div>
        <nav class="navegacion">
            <a class="navegacion__enlace" href="index.php"> Inicio </a>
            <a class="navegacion__enlace" href="registro.php"> Registrarse </a>
        </nav>
    </header>
    <div class="contenedor">
        <section class="registro">
            <h2 class="registro__titulo">Zona de Ingreso</h2>
            <form class="formularioingreso" action="ingresando.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <!-- fieldset es para agrupar datos que estan dentro de un mismo formulario -->
                <fieldset>
                    <!-- legend es como un titulo para un grupo de datos -->
                    <legend>Ingrese Correctamente los Datos de su Usuario</legend>
                    <div>

                        <div class="campos">
                            <label for="input01">Usuario: </label>
                            <input class="inputEstilos" type="text" name="usuario" placeholder="Tu Usuario" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label for="input02">Clave: </label>
                            <input class="inputEstilos" type="password" name="clave" placeholder="Tu Clave" pattern="[a-zA-Z0-9ñÑ ]+" required>
                        </div>
                        <div class="campos">
                            <label>Captcha:</label>
                            <?php
                                $captcha_text = rand(1000, 9999);
                                echo "<label>".$captcha_text."</label>"; /* rand recibe un entero minimo y uno maximo es para un rango */
                            ?>
                            <input class="inputEstilos" type="text" name="captcha" placeholder="Ingrese el Captcha" min="1000" pattern="<?php echo $captcha_text ?>" required>
                        </div>
                        <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">
                        <div>
                            <input class="boton" type="submit" value="Ingresar">
                        </div>
                        <div>
                            <center>
                            <p class="campos">
                                ¿No tienes una cuenta? <br>
							<a href="registro.php">Regístrate</a>
						    </p>
                            </center>
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