<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login V17</title>
    <link rel="stylesheet" href="ingreso.css">
    <style>
        /* Aplica estilos CSS para hacer más pequeño el contenido */
        .login-container {
            max-width: 500px; /* Ancho máximo del contenedor */
            margin: auto; /* Centra el contenedor horizontalmente */
            padding: 20px; /* Espacio interno alrededor del contenedor */
            
        }

        .login-image img {
            max-width: 100%; /* Hace que la imagen sea responsive dentro de su contenedor */
            display: block; /* Elimina los márgenes por defecto de la imagen */
            margin: auto; /* Centra la imagen horizontalmente */
        }

        .login-form {
            margin-top: 20px; /* Espacio entre la imagen y el formulario */
        }

        .input100 {
            width: 100%; /* Ancho del campo de entrada al 100% del contenedor */
        }

        .container-login100-form-btn {
            text-align: center; /* Centra el botón de inicio de sesión */
        }

        .login100-form-btn {
            width: 100%; /* Ancho del botón al 100% del contenedor */
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-image">
            <!-- Puedes cambiar 'path/to/your/image.jpg' con la ruta de tu imagen -->
            <img src="fotosperfil/Logo con fondo.jpg" alt="Login Image">
        </div>
        <div class="login-form">
            <form class="login100-form validate-form" action="ingresando.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <span class="login100-form-title p-b-34">
                    Account Login
                    <BR></BR>
                    <br>
                </span>

                <br>
                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                    <input id="first-name" class="input100" type="text" name="usuario" placeholder="User name">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                    <input class="input100" type="password" name="clave" placeholder="Password">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type captcha">
                    <?php
                        $captcha_text = rand(1000, 9999);
                        echo "<label>Captcha: ".$captcha_text."</label>"; /* rand recibe un entero mínimo y uno máximo es para un rango */
                    ?>
                    <br>
                    <br>
                    <input class="input100" type="text" name="captcha" placeholder="Ingrese el Captcha" pattern="<?php echo $captcha_text ?>" required>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Sign in
                    </button>
                </div>
                <br>
                <div class="w-full text-center">
                    <a href="registro.php" class="txt3">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
