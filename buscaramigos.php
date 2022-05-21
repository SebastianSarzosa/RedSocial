<?php 

include('conexion.php'); 
include('sesion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigos</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header8">
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto">Buscando Amigos</h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="amigos.php"> Amigos </a>
            </nav>
        </div>
    </header>
    <div class="contenedor">
        <br>
        <center><h3>No Agregues Desconocidos.</h3></center>
        <br> 
        <main>
            <h4 class="no-margin centrar-texto">Personas que quizas conozcas.</h4>
            <hr>
            <br>
            <div>
                <?php

                    $consultaamigos = $conn -> query("select * from usuarios");
                    $contador = $consultaamigos->rowcount();
                    if ($contador > 0){ 
                        while($datosamigos = $consultaamigos->fetch()){   
                            $id_amigo = $datosamigos['id_usuario'];
                    
                ?>
                <br>
                <form class="formulariobuscandoamiguis" action="nuevoamigo.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                    
                    <div class="contenedordatos"> 
                        <aside class="sidebar">
                            <br><br><br><br>
                            <?php
                            $id = $datosamigos['id_usuario'];
                            ?>
                            <div class="campos">
                                <label for="img">Foto de perfil: </label>
                                <?php if($datosamigos['foto_perfil'] != null){
                                    ?> <img class="imageninicio" src="<?php echo $datosamigos['foto_perfil']; ?>"> <?php
                                } else {
                                    ?> <img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg"> <?php
                                } ?>
                            </div>
                            <div>
                                <center><input name="id_amigo" type="hidden" value="<?php echo $datosamigos['id_usuario']; ?>"></center>
                            </div>
                            <div>
                                <?php

                                    $revisionamigo = $conn -> query("SELECT id_relacion_amistad, id_usuario, 
                                    id_amigo_usuario FROM amistades WHERE id_usuario = '$session_id' 
                                    AND id_amigo_usuario = $id OR id_usuario = '$id' 
                                    AND id_amigo_usuario = $session_id");
                                    $datosamistad = $revisionamigo->fetch();
                                    if($datosamistad != null){

                                ?>
                                    <center><input class="boton_a" type="text" value="Ya es tu Amigo(a)"></center>
                                <?php

                                    } else {

                                ?>
                                    <center><input class="boton" type="submit" value="Agregar Amigo(a)"></center>
                                <?php

                                    }

                                ?>
                            </div>
                        </aside>
                        <div class="camposdaticos">
                            <div>
                                <label for="input01">Nombre Completo: </label>
                                <p class="datosusuario"><?php echo $datosamigos['nombres']." ".$datosamigos['apellidos']; ?></p>
                            </div>
                            <div>
                                <label for="input03">Correo: </label>
                                <p class="datosusuario"><?php echo $datosamigos['correo'] ?></p>
                            </div>  
                            <div>
                                <label for="input03">Fecha Nacimiento: </label>
                                <p class="datosusuario"><?php echo $datosamigos['fecha_nacimiento'] ?></p>
                            </div>  
                            <div>
                                <label for="input03">Cedula: </label>
                                <p class="datosusuario"><?php echo $datosamigos['cedula'] ?></p>
                            </div>   
                            <div>
                                <label for="input03">Cantidad Hijos: </label>
                                <p class="datosusuario"><?php echo $datosamigos['cantidad_hijos'] ?></p>
                            </div>   
                            <div>
                                <label for="input03">Estado Civil: </label>
                                <p class="datosusuario"><?php echo $datosamigos['estado_civil'] ?></p>
                            </div> 
                        </div>           
                    </div>
                </form> 
                <br>
                <hr>  
                <?php
                    }
                } else {
                    echo "<h1>No hay personas registradas.</h1>";
                }

                ?> 
            </div>
        </main>
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