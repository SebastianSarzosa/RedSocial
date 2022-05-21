<?php include('conexion.php'); ?>
<?php include('sesion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MisArticulos</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header5">    
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto"> Mis Articulos </h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="inicio.php"> Inicio </a>
                <a class="navegacion__enlace" href="todosarticulos.php"> Todos los Articulos </a>
                <a class="navegacion__enlace" href="nuevoarticulo.php"> Crear un Articulo </a>
            </nav>
        </header>
    </div>
    <div class="contenedor"> 
        <br> 
        <main>
            <center><h3>Mis Públicaciones</h3></center>
            <hr>
            <br>
            <div>
                <?php

                    $consultapublicacion = $conn -> query("SELECT articulos.id_articulo,  articulos.texto_articulo,
                    articulos.fecha_publicacion, articulos.articulo_privado,
                    usuarios.id_usuario, usuarios.nombres, usuarios.apellidos, usuarios.cedula, 
                    usuarios.correo, usuarios.foto_perfil FROM articulos
                    INNER JOIN usuarios ON usuarios.id_usuario = articulos.id_usuario
                    WHERE articulos.articulo_privado = 'on' AND usuarios.id_usuario = $session_id
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
                                <label for="img">Foto de Autor: </label>
                                <?php if($datospublicacion['foto_perfil'] != null){
                                    ?> <img class="imageninicio" src="<?php echo $datospublicacion['foto_perfil']; ?>"> <?php
                                } else {
                                    ?> <img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg"> <?php
                                } ?>
                            </div>
                            <div>
                                <center><input name="id_articulo" type="hidden" value="<?php echo $datospublicacion['id_articulo']; ?>"></center>
                            </div>
                            <div>
                                <center><input class="boton" name="eliminar" type="submit" value="Eliminar Publicación"></center>
                            </div>
                            <div>
                                <center><input class="boton" name="cambio" type="submit" value="Cambiar a Público"></center>
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