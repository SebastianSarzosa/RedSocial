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
            <link rel="stylesheet" href="actualizarperfil_GUI.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .main{
                    top: 95px;
                    position: relative;
                }
                label{
                    padding: 3px 0;
                }
            </style>
        </head>
        <body>
            <?php
                include("menu_bar.php")
            ?>
            <div class="contenedor">
                <main class="main">
                    <center><h1>Datos del Usuario</h1></center>
                    <hr>
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
                                    <center><img class="img-fluid w-25" src="fotosperfil/<?php echo $image; ?>" alt="Foto de perfil"></center>
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
                                    <div class="col-md-3">
                                        <label for="input01">Nombres: </label><br>
                                        <label for="input02">Apellidos: </label><br>
                                        <label for="input03">Correo: </label><br>
                                        <label for="input04">Fecha de Nacimiento: </label>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="inputEstilos" type="text" name="nombres" value="<?php echo $datosusuario['nombres']; ?>" pattern="[a-zA-Z0-9ñÑ ]+" required>
                                        <input class="inputEstilos" type="text" name="apellidos" value="<?php echo $datosusuario['apellidos']; ?>" pattern="[a-zA-Z0-9ñÑ ]+" required>
                                        <input class="inputEstilos" type="email" name="correo" value="<?php echo $datosusuario['correo']; ?>" pattern="[a-zA-Z0-9ñÑ @.]+" required><br>
                                        <input class="inputEstilos" type="date" name="fecha_nacimiento" value="<?php echo $datosusuario['fecha_nacimiento']; ?>" pattern="[a-zA-Z0-9ñÑ ]+" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="input05">Cédula: </label><br>
                                        <label for="input06">Cantidad de Hijos: </label><br>
                                        <label for="input07">Estado civil: </label><br>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <input class="inputEstilos" type="number" name="cedula" value="<?php echo $datosusuario['cedula']; ?>" min="0" maxlength="11" pattern="[0-9]+" required>
                                        <input class="inputEstilos" type="number" name="cantidad_hijos" value="<?php echo $datosusuario['cantidad_hijos']; ?>" min="0" maxlength="3" pattern="[0-9]+" required>
                                        <select class="inputEstilos" type="text" name="estado_civil" value="<?php echo $datosusuario['estado_civil']; ?>" pattern="[a-zA-Z0-9ñÑ]+" required>
                                            <option value="Soltero">Soltero/a</option>
                                            <option value="Casado">Casado/a</option>
                                            <option value="Viudo">Viudo/a</option>
                                        </select>                                        
                                    </div>
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>