<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiRedSocial</title>
    <style>
    /* Estilos para la página */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    
        
    }

    .contenedor {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .header {
        background-color: #94c6d1;
        padding: 10px 0;
    }

    .logo {
        margin: 0;
    }

    .navegacion {
        text-align: right;
    }

    .navegacion__enlace {
        color: #fff;
        text-decoration: none;
        margin-left: 20px;
    }

    .navegacion__enlace--sesion {
        margin-left: 40px;
    }

    .main {
        display: flex;
        justify-content: center; /* Cambio realizado aquí para centrar horizontalmente */
        flex-wrap: wrap;
    }

    .publicacion {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        width: calc(90.33% - 20px);
        box-sizing: border-box;
    }

    .publicacion img {
        max-width: 100%;
        display: block;
        margin: 0 auto 10px;
    }

    .reacciones {
        margin-top: 10px;
    }

    .reaccion {
        color: #333;
        text-decoration: none;
        margin-right: 10px;
    }

    footer {
        background-color: #333;
        color: #fff;
        padding: 10px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
</head>
<body>
    <header class="header">
        <div class="contenedor">
            <h1 class="logo">MiRedSocial</h1>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="todosarticulos.php">Articulos</a>
                <a class="navegacion__enlace" href="mensajesrecibidos.php">Mensajes</a>
                <a class="navegacion__enlace" href="perfil.php">Perfil</a>
                <a class="navegacion__enlace" href="amigos.php">Amigos</a>
                <a class="navegacion__enlace--sesion" href="cerrarsesion.php">Cerrar Sesión</a>
            </nav>
        </div>
    </header>
    <div class="contenedor">
        <main class="main">
            <section class="publicaciones-section">
                <?php
                // Aquí incluye tu archivo de conexión a la base de datos
                include('conexion.php');
                
                // Realiza la consulta para obtener las publicaciones
                $consultaArticulos = $conn->query("SELECT * FROM articulos ORDER BY fecha_publicacion DESC");

                // Comprueba si hay artículos
                if ($consultaArticulos->rowCount() > 0) {
                    while ($articulo = $consultaArticulos->fetch()) {
                ?>
                <div class="publicacion">
                    <div class="publicacion-info">
                        <h3><?php echo $articulo['id_usuario']; ?></h3>
                        <span class="fecha-publicacion">Fecha de publicación: <?php echo $articulo['fecha_publicacion']; ?></span>
                    </div>
                    <?php if (isset($articulo['texto_articulo'])) : ?>
                        <p><?php echo $articulo['texto_articulo']; ?></p>
                    <?php else : ?>
                        <p>Contenido no disponible.</p>
                    <?php endif; ?>
                    <?php
                    if (!empty($articulo['imagen_perfil'])) {
                        $imagenURL = 'data:image/jpeg;base64,' . base64_encode($articulo['imagen_perfil']);
                    ?>
                    <img src="<?php echo $imagenURL; ?>" alt="Imagen del artículo ">
                    <?php } ?>
                    <div class="reacciones">
                        <!-- Aquí puedes agregar las opciones de reacciones -->
                        <a href="#" class="reaccion">Me gusta</a>
                        <a href="#" class="reaccion">Comentar</a>
                        <a href="#" class="reaccion">Compartir</a>
                    </div>
                </div>
                <div class="publicacion">
                    <div class="publicacion-info">
                        <h3><?php echo $articulo['id_usuario']; ?></h3>
                        <span class="fecha-publicacion">Fecha de publicación: <?php echo $articulo['fecha_publicacion']; ?></span>
                    </div>
                    <?php if (isset($articulo['texto_articulo'])) : ?>
                        <p><?php echo $articulo['texto_articulo']; ?></p>
                    <?php else : ?>
                        <p>Contenido no disponible.</p>
                    <?php endif; ?>
                    <?php
                    if (!empty($articulo['imagen_perfil'])) {
                        $imagenURL = 'data:image/jpeg;base64,' . base64_encode($articulo['imagen_perfil']);
                    ?>
                    <img src="<?php echo $imagenURL; ?>" alt="Imagen del artículo ">
                    <?php } ?>
                    <div class="reacciones">
                        <!-- Aquí puedes agregar las opciones de reacciones -->
                        <a href="#" class="reaccion">Me gusta</a>
                        <a href="#" class="reaccion">Comentar</a>
                        <a href="#" class="reaccion">Compartir</a>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p>No hay artículos publicados.</p>";
                }
                ?>
            </section>
        </main>
    </div>
</body>
</html>
