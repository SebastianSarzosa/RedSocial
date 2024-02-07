<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            margin: 20px 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F2F2F2; /* Color de fondo */
        }

        .login-form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column; /* Centra los elementos verticalmente */
            padding: 20px;
            width: 90%; /* Ajusta según sea necesario */
            max-width: 600px; /* Ancho máximo del formulario */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra */
        }

        .campos {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .columna {
            width: 48%;
            margin-bottom: 20px;
        }

        .campos label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .inputEstilos {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login100-form-btn {
            background-color: #63B8EE;
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            width: 100%;
            max-width: 150px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .login100-form-btn:hover {
            background-color: #4a8dc1;
        }

        .ingresa {
            text-decoration: none;
            color: #63B8EE;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .ingresa:hover {
            color: #4a8dc1;
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        @media screen and (max-width: 576px) {
            .columna {
                width: 100%;
            }
        }
        @media screen and (max-width: 768px) {
    /* Estilos específicos para dispositivos móviles */
    .login-form {
        width: 80%;
    }
}

@media screen and (max-width: 576px) {
    /* Estilos específicos para dispositivos más pequeños */
    .columna {
        width: 100%;
    }
}
    </style>
</head>
<body>
    <div class="login-form">
        <form class="formulario" action="registrandose.php" method="POST" autocomplete="on" enctype="multipart/form-data">
            <h3>Registrarse</h3>
            <div class="campos">
                <div class="columna">
                    <label for="input01">Nombres: </label>
                    <input class="inputEstilos form-control" name="nombres" type="text" placeholder="Tus nombres" pattern="[a-zA-ZñÑ\s]+" required>
                </div>
                <div class="columna">
                    <label for="input02">Apellidos: </label>
                    <input class="inputEstilos form-control" name="apellidos" type="text" placeholder="Tus apellidos" pattern="[a-zA-Z0-9ñÑ\s]+" required>
                </div>
            </div>
            <div class="campos">
                <div class="columna">
                    <label for="input03">Correo: </label>
                    <input class="inputEstilos form-control" name="correo" type="email" placeholder="Tu Correo" pattern="[a-zA-Z0-9ñÑ@.]+" required>
                </div>
                <div class="columna">
                    <label for="input04">Fecha de Nacimiento: </label>
                    <input class="inputEstilos form-control" name="fecha_nacimiento" type="date" placeholder="Tu Fecha de Nacimiento" required max="<?php echo date('Y-m-d',strtotime('-18 years')); ?>">
                </div>
            </div>
            <div class="campos">
                <div class="columna">
                    <label for="input05">Cédula: </label>
                    <input class="inputEstilos form-control" name="cedula" type="number" placeholder="Tu Cedula" min="0" maxlength="11" pattern="[0-9]+" required>
                </div>
                <div class="columna">
                    <label for="input06">Cantidad de Hijos: </label>
                    <input class="inputEstilos form-control" name="cantidad_hijos" type="number" placeholder="Tu Cantidad de Hijos" min="0" maxlength="3" pattern="[0-9]+" required>
                </div>
            </div>
            <div class="campos">
                <div class="columna">
                    <label for="input07">Estado civil: </label>
                    <select class="estiloinput seleccionar form-control" name="estado_civil" type="text" placeholder="Tu Estado civil" pattern="[a-zA-Z0-9ñÑ]+" required>
                        <option disabled selected>Seleccione una opción</option>
                        <option value="Soltero">Soltero/a</option>
                        <option value="Casado">Casado/a</option>
                        <option value="Viudo">Viudo/a</option>
                    </select>
                </div>
                <div class="columna">
                    <label for="input08">Usuario: </label>
                    <input class="inputEstilos form-control" name="nombre_usuario" type="text" placeholder="Tu Usuario" pattern="[a-zA-Z0-9ñÑ\s]+" required>
                </div>
            </div>
            <div class="campos">
                <div class="columna">
                    <label for="input09">Clave: </label>
                    <input class="inputEstilos form-control" name="clave" type="password" placeholder="Tu Clave" pattern="[a-zA-Z0-9ñÑ\s]+" required>
                </div>
                <div class="columna">
                    <label for="input10">Confirmar Clave: </label>
                    <input class="inputEstilos form-control" name="confirmarclave" type="password" placeholder="Confirmar Clave" pattern="[a-zA-Z0-9ñÑ\s]+" required>
                </div>
            </div>

            <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">
            <br>

            <button class="login100-form-btn" type="submit" onclick="return validarFormulario()">Registrar</button>

            <div class="row w-50">
                <div class="col-md-6 text-center">
                    <p class="campos">
                        ¿Ya tienes cuenta? <a href="ingreso.php" class="ingresa">Ingresa</a>
                    </p>
                </div>
            </div>
        </form>
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
            if (!validarEdad()) {
                alert("Debe ser mayor de 18 años para registrarse");
                return false;
            }
            // Agrega más validaciones según sea necesario

            // Si todas las validaciones son exitosas, muestra el mensaje y devuelve true
            alert("Registro completado con éxito");
            return true;
        }

        function validarNombres() {
            const nombres = document.querySelector("input[name='nombres']").value;
            return nombres.match(/^[A-Za-zñÑ\s]+$/);
        }

        function validarApellidos() {
            const apellidos = document.querySelector("input[name='apellidos']").value;
            return apellidos.match(/[a-zA-Z0-9ñÑ\s]+/);
        }

        function validarCorreo() {
            const correo = document.querySelector("input[name='correo']").value;
            // Puedes usar una expresión regular más compleja para validar correos electrónicos
            // Esto es solo un ejemplo simple
            return correo.includes('@');
        }

        function validarEdad() {
            const fechaNacimiento = new Date(document.querySelector("input[name='fecha_nacimiento']").value);
            const hoy = new Date();
            const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            const mes = hoy.getMonth() - fechaNacimiento.getMonth();

            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                return edad - 1;
            }

            return edad;
        }
    </script>
</body>
</html>
