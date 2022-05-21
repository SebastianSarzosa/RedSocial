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
    <title>Articulos</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header5">    
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto"> Todos los Articulos </h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="inicio.php"> Inicio </a>
                <a class="navegacion__enlace" href="misarticulos.php"> Mis Articulos </a>
                <a class="navegacion__enlace" href="nuevoarticulo.php"> Crear un Articulo </a>
            </nav>
        </div>
    </header>
    <div class="contenedor"> 
        <br> 
        <main>
            <center><h3>Públicaciones</h3></center>
            <hr>
            <br>
            <div>
                <?php
                    $consultapublicacion = $conn -> query("SELECT articulos.id_articulo,  articulos.texto_articulo,
                    articulos.fecha_publicacion, articulos.articulo_privado,
                    usuarios.id_usuario, usuarios.nombres, usuarios.apellidos, usuarios.cedula, 
                    usuarios.correo, usuarios.foto_perfil FROM articulos
                    INNER JOIN usuarios ON usuarios.id_usuario = articulos.id_usuario
                    WHERE articulos.articulo_privado = 'off'
                    ORDER BY articulos.id_articulo DESC");
                    $contador = $consultapublicacion->rowcount();
                    if ($contador > 0){ 
                        while($datospublicacion = $consultapublicacion->fetch()){   

                ?>
                <br>
                <form class="formularioarticulitos" action="eliminararticulo.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                    
                    <div class="contenedordatos"> 
                        <aside class="sidebar">
                            <br><br><br><br>
                            <?php
                            $id = $datospublicacion['id_articulo'];
                            ?>
                            <div class="campos">
                                <label for="img">Foto de perfil: </label>
                                <?php if($datospublicacion['foto_perfil'] != null){
                                    ?> <img class="imageninicio" src="<?php echo $datospublicacion['foto_perfil']; ?>"> <?php
                                } else {
                                    ?> <img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg"> <?php
                                } ?>
                            </div>
                            
                            <?php

                                if($datospublicacion['id_usuario'] == $session_id){

                            ?>
                            <div>
                                <center><input class="boton" name="eliminar" type="submit" value="Eliminar Publicación"></center>
                            </div>
                            <?php

                                }else{

                            ?>
                            <div>
                                <center><input name="id_articulo" type="hidden" value="<?php echo $datospublicacion['id_articulo']; ?>"></center>
                                <center><input class="boton_a" type="text" value="No se puede Eliminar"></center>
                            </div>
                            <?php

                                }

                            ?>
                            <div>
                                <?php

                                    $revisionamigo = $conn -> query("SELECT id_articulo, id_usuario, 
                                    texto_articulo, articulo_privado, fecha_publicacion 
                                    FROM articulos WHERE id_usuario = '$session_id' and id_articulo = $id");
                                    $datosamistad = $revisionamigo->fetch();
                                    if($datosamistad != null){

                                ?>
                                    <center><input class="boton" name="cambiecito" type="submit" value="Cambiar a Privado"></center>
                                    
                                <?php

                                    } else {

                                ?>
                                    <center><input class="boton_a" type="text" value="No lo puedes cambiar"></center>
                                <?php

                                    }

                                ?>
                            </div>
                      
                        </aside>
                        <div class="camposdaticos">
                            <div>
                                <label for="input01">Nombre Completo: </label>
                                <p class="datosusuario"><?php echo $datospublicacion['nombres']." ".$datospublicacion['apellidos']; ?></p>
                            </div>
                            <div>
                                <label for="input03">Correo: </label>
                                <p class="datosusuario"><?php echo $datospublicacion['correo'] ?></p>
                            </div>  
                            <div>
                                <label for="input03">Cedula: </label>
                                <p class="datosusuario"><?php echo $datospublicacion['cedula'] ?></p>
                            </div> 
                            <div>
                                <label for="input03">Publicación: </label>
                                <p class="datosusuario"><?php echo $datospublicacion['texto_articulo'] ?></p>
                            </div> 
                            <div>
                                <label for="input03">Fecha del Publicación: </label>
                                <p class="datosusuario"><?php echo $datospublicacion['fecha_publicacion'] ?></p>
                            </div> 
                        </div>           
                    </div>
                    <input name="id_articulo" type="hidden" value="<?php echo $datospublicacion['id_articulo']; ?>">
                    <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">
                </form> 
                <br>
                <hr>  
                <?php
                            
                        }
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