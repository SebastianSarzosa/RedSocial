<?php include('conexion.php'); ?>
<?php include('sesion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedSocial</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header4">
        <div class="contenedor">
            <a class="navegacion__enlace--sesion" href="cerrarsesion.php"> Cerrar Sesión </a>
        </div>
        <div class="contenedor">
            <div class="contenedor__titulo3">
                <h1 class="no-margin centrar-texto">Inicio</h1>
            </div>
            <nav class="navegacion2">
                <a class="navegacion__enlace" href="todosarticulos.php"> Articulos </a>
                <a class="navegacion__enlace" href="mensajesrecibidos.php"> Mensajes </a>
                <a class="navegacion__enlace" href="perfil.php"> Perfil </a>
                <a class="navegacion__enlace" href="amigos.php"> Amigos </a>
            </nav>
        </div>
    </header>
    <div class="contenedor">
        <main>
            <h2 class="registro__titulo">Datos del Usuario</h2>
            <article class="entrada">
                <div class="contenedordatos"> 
                    <aside class="sidebar">
                        <?php
                        $consultadatospersonales = $conn->query("select * from usuarios where id_usuario = '$session_id'");
                        $datosusuario = $consultadatospersonales->fetch();
                        $id = $datosusuario['id_usuario'];
                        ?>
                        <div class="campos">
                            <label for="img">Foto de perfil: </label>
                            <?php if($datosusuario['foto_perfil'] != null){
                                ?> <img class="imageninicio" src="<?php echo $image; ?>"> <?php
                            } else {
                                ?> <img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg"> <?php
                            } ?>
                        </div>
                    </aside>
                    <div class="camposdaticos">
                        <div>
                            <label for="input01">Nombre Completo: </label>
                            <p class="datosusuario"><?php echo $datosusuario['nombres']." ".$datosusuario['apellidos']; ?></p>
                        </div>
                        <div>
                            <label for="input03">Correo: </label>
                            <p class="datosusuario"><?php echo $datosusuario['correo'] ?></p>
                        </div>   
                    </div>           
                </div>
            </article>
        </main>
    </div>
    <footer>
    <div class="contenedor">
        <div class="descripcion__titulo">
            <p class="descripcion__texto">Hecho por Juan Pablo</p>      
        </div>
    </div>
    </footer>
</body>
</html>