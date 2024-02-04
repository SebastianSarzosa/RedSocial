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
            <title>Perfil</title>
            <link rel="stylesheet" href="css/normalice.css">
            <link rel="stylesheet" href="perfil.css.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
        </head>
        <body>
        <header class="header7">
            <div class="contenedor">
                <div class="contenedor__titulo2">
                    <h1 class="no-margin centrar-texto">Perfil</h1>
                </div>
                <nav class="navegacion">
                    <a class="navegacion__enlace1" href="inicio.php"> inicio </a>
                </nav>
            </div>
        </header>
            <div class="container">
                <main>
                    <h2>Datos del Usuario</h2>
                    <article>
                        <div>
                            <?php
                            $consultadatospersonales = $conn->query("select * from usuarios where id_usuario = '$session_id'");
                            $datosusuario = $consultadatospersonales->fetch();
                            $id = $datosusuario['id_usuario'];
                            ?>
                            <div>
                                <h3 class="titulo-foto-perfil">Foto de perfil</h3>
                                <?php if($datosusuario['foto_perfil'] != null) { ?>
                                    <center><img class="img-fluid w-25" src="<?php echo $image; ?>" alt="Foto de perfil"></center>
                                <?php } else { ?>
                                    <center><img class="img-fluid" src="fotosperfil/sinfotoperfil.jpg" height="100" width="160" alt="Sin foto de perfil"></center>
                                <?php } ?>
                            </div>
                            <div>
                                <center><a class="boton" type="button" href="cambiofotoperfil.php">Cambiar la Foto de Perfil</a></center>
                            </div>
                        </div>
                        <div>
                        <br><br>
                            <center><h4>Datos Personales</h4></center>
                            <form class="formularioperfil" action="actualizarperfil.php" method="POST" autocomplete="on">
                                <div>
                                    <input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="input01">Nombres: </label>
                                        <input class="inputEstilos" type="text" name="nombres" value="<?php echo $datosusuario['nombres']; ?>" pattern="[a-zA-Z0-9ñÑ ]+" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="input02">Apellidos: </label>
                                        <input class="inputEstilos" type="text" name="apellidos" value="<?php echo $datosusuario['apellidos']; ?>" pattern="[a-zA-Z0-9ñÑ ]+" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="input03">Correo: </label>
                                        <input class="inputEstilos" type="email" name="correo" value="<?php echo $datosusuario['correo']; ?>" pattern="[a-zA-Z0-9ñÑ @.]+" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="input04">Fecha de Nacimiento: </label>
                                        <input class="inputEstilos" type="date" name="fecha_nacimiento" value="<?php echo $datosusuario['fecha_nacimiento']; ?>" pattern="[a-zA-Z0-9ñÑ ]+" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="input05">Cédula: </label>
                                        <input class="inputEstilos" type="number" name="cedula" value="<?php echo $datosusuario['cedula']; ?>" min="0" maxlength="11" pattern="[0-9]+" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="input06">Cantidad de Hijos: </label>
                                        <input class="inputEstilos" type="number" name="cantidad_hijos" value="<?php echo $datosusuario['cantidad_hijos']; ?>" min="0" maxlength="3" pattern="[0-9]+" required>
                                    </div>
                                </div>
                                <div>
                                    <label for="input07">Estado civil: </label>
                                    <select class="inputEstilos" type="text" name="estado_civil" value="<?php echo $datosusuario['estado_civil']; ?>" pattern="[a-zA-Z0-9ñÑ]+" required>
                                        <option value="Soltero">Soltero/a</option>
                                        <option value="Casado">Casado/a</option>
                                        <option value="Viudo">Viudo/a</option>
                                    </select>
                                </div> 
                                <br>
                                <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">
                                <div>
                                    <center><input name="actualizar" class="boton" type="submit" value="Actualizar Datos"></center>
                                </div> 
                            </form> 
                            <br>
                            <div class="mb-4">
                                <a class="boton" type="submit" href="cambiocontrasena.php">Cambiar la Contraseña o Usuario</a>
                            </div>               
                        </div>
                    </article>
                </main>
            </div>
        </body>
        </html>