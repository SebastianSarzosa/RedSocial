<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="registr.css">
</head>

<body>
    <div class="login-container">
        <div class="login-image">
            <!-- Puedes cambiar 'path/to/your/image.jpg' con la ruta de tu imagen -->
            <img src="imagenes/2.png" alt="Login Image">
        </div>
        <div class="login-form">
            <form class="formulario" action="registrandose.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                <span class="login100-form-title p-b-34">
                    Account Registration
                    <BR></BR>
                </span>
                <div class="campos">
                    <div class="columna">
                        <label for="input01">Nombres: </label>
                        <input class="inputEstilos" name="nombres" type="text" placeholder="Tus nombres" pattern="[a-zA-Z0-9ñÑ ]+" required>
                    </div>
                    <div class="columna">
                        <label for="input02">Apellidos: </label>
                        <input class="inputEstilos" name="apellidos" type="text" placeholder="Tus apellidos" pattern="[a-zA-Z0-9ñÑ ]+" required>
                    </div>
                </div>
                <div class="campos">
                    <div class="columna">
                        <label for="input03">Correo: </label>
                        <input class="inputEstilos" name="correo" type="email" placeholder="Tu Correo" pattern="[a-zA-Z0-9ñÑ @.]+" required>
                    </div>
                    <div class="columna">
                        <label for="input04">Fecha de Nacimiento: </label>
                        <input class="inputEstilos" name="fecha_nacimiento" type="date" placeholder="Tu Fecha de Nacimiento" pattern="[a-zA-Z0-9ñÑ ]+" required>
                    </div>
                </div>
                <div class="campos">
                    <div class="columna">
                        <label for="input05">Cédula: </label>
                        <input class="inputEstilos" name="cedula" type="number" placeholder="Tu Cedula" min="0" maxlength="11" pattern="[0-9]+" required>
                    </div>
                    <div class="columna">
                        <label for="input06">Cantidad de Hijos: </label>
                        <input class="inputEstilos" name="cantidad_hijos" type="number" placeholder="Tu Cantidad de Hijos" min="0" maxlength="3" pattern="[0-9]+" required>
                    </div>
                </div>
                <div class="campos">
                    <div class="columna">
                        <label for="input07">Estado civil: </label>
                        <select class="estiloinput seleccionar" name="estado_civil" type="text" placeholder="Tu Estado civil" pattern="[a-zA-Z0-9ñÑ]+" required>
                            <option disabled selected>Seleccione una opción</option>
                            <option value="Soltero">Soltero/a</option>
                            <option value="Casado">Casado/a</option>
                            <option value="Viudo">Viudo/a</option>
                        </select>
                    </div>
                    <div class="columna">
                        <label for="input08">Usuario: </label>
                        <input class="inputEstilos" name="nombre_usuario" type="text" placeholder="Tu Usuario" pattern="[a-zA-Z0-9ñÑ ]+" required>
                    </div>
                </div>
                <div class="campos">
                    <div class="columna">
                        <label for="input09">Clave: </label>
                        <input class="inputEstilos" name="clave" type="password" placeholder="Tu Clave" pattern="[a-zA-Z0-9ñÑ ]+" required>
                    </div>
                    <div class="columna">
                        <label for="input10">Confirmar Clave: </label>
                        <input class="inputEstilos" name="confirmarclave" type="password" placeholder="Confirmar Clave" pattern="[a-zA-Z0-9ñÑ ]+" required>
                    </div>
                </div>

                <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">

                <div class="boton">
                    <button class="login100-form-btn" type="submit" onclick="return validarFormulario()">
                        Registrar
                    </button>
                </div>
                <div>
                    <center>
                        <p class="campos">
                            ¿Ya tienes cuenta? <br>
                            <a href="ingreso.php">Ingresa</a>
                        </p>
                    </center>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validarFormulario() {
            // Lógica de validación
            if (!validarNombres()) {
                alert("Ingrese nombres válidos");
                return false;
            }
            if (!validarApellidos()) {
                alert("Ingrese apellidos válidos");
                return false;
            }
            if (!validarCorreo()) {
                alert("Ingrese un correo válido");
                return false;
            }
            // Agrega más validaciones según sea necesario

            // Si todas las validaciones son exitosas, muestra el mensaje y devuelve true
            alert("Registro completado con éxito");
            return true;
        }

        function validarNombres() {
            const nombres = document.querySelector("input[name='nombres']").value;
            return nombres.match(/[a-zA-Z0-9ñÑ ]+/);
        }

        function validarApellidos() {
            const apellidos = document.querySelector("input[name='apellidos']").value;
            return apellidos.match(/[a-zA-Z0-9ñÑ ]+/);
        }

        function validarCorreo() {
            const correo = document.querySelector("input[name='correo']").value;
            // Puedes usar una expresión regular más compleja para validar correos electrónicos
            // Esto es solo un ejemplo simple
            return correo.includes('@');
        }
    </script>
</body>

</html>
