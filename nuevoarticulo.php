<?php include('conexion.php'); ?>
<?php include('sesion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrearArticulo</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header5">
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto"> Crear un Articulo </h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="inicio.php"> Inicio </a>
                <a class="navegacion__enlace" href="todosarticulos.php"> Todos los Articulos </a>
                <a class="navegacion__enlace" href="misarticulos.php"> Mis Articulos </a>
            </nav>
        </div>
    </header>
    <div class="contenedor">
        <?php
        $consultadatospersonales = $conn->query("select * from usuarios where id_usuario = '$session_id'");
        $datosusuario = $consultadatospersonales->fetch();
        $id = $datosusuario['id_usuario'];
        ?>
        <form class="formulario__articulo--nuevo" action="insertandoarticulo.php" method="POST" autocomplete="on" enctype="multipart/form-data"> 
            <div class="contenedordatosautor"> 
                    <aside class="sidebar">
                        <div class="campos">
                            <label class="descripcion__texto" for="img">Foto de autor: </label>
                            <?php if($datosusuario['foto_perfil'] != null){
                                ?> <img class="imageninicio" src="<?php echo $image; ?>"> <?php
                            } else {
                                ?> <img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg"> <?php
                            } ?>
                        </div>
                    </aside>
                    <div class="camposdaticos">
                        <div>
                            <label class="descripcion__texto" for="input01">Nombre Autor: </label>
                            <p class="datosusuario"><?php echo $datosusuario['nombres']." ".$datosusuario['apellidos']; ?></p>
                        </div>
                    </div>
            </div>
            <hr>
            <div>
                <center><h3>Proceso de Públicación</h3></center>
                <p class="titulopublicacion">Texto a Públicar:</p>
                <input class="inputEstilosarticulos" name="publicacion" type="text" placeholder="Que desea públicar" pattern="[a-zA-Z0-9ñÑ áéíóúÁÉÍÓÚ.,@?¿!/*-+]+" required> 
            </div>
            <br>
            <div>
                <label class="descripcion__texto">Privado</label>
                <input class="cajita" name="privado" type="checkbox">
                <br>
                <hr>
                <p class="descripcion__texto">Si desea que sea privado (solo para el autor) seleccione la opción privado y si desea que sea público (para que lo puedan ver todos) no seleccione nada</p>
            </div>
            <div>
                <input class="boton" name="boton" type="submit" value="Públicar">
            </div>
        </form>
    </div>
    <br>
    <footer>
    <div class="contenedor">
        <div class="descripcion__titulo">
            <p class="descripcion__texto">Hecho por Juan Pablo</p>      
        </div>
    </div>
    </footer>
    <br><br>
</body>
</html>