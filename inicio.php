<?php include('conexion.php'); ?>
<?php include('sesion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedSocial</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="inicios.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="contenedor">
            <h1 class="logo">RedSocial</h1>
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
        <main>
            <section class="perfil-section">
                <div class="perfil">
                    <div class="foto-perfil">
                        <?php
                        $consultadatospersonales = $conn->query("select * from usuarios where id_usuario = '$session_id'");
                        $datosusuario = $consultadatospersonales->fetch();
                        $id = $datosusuario['id_usuario'];
                        ?>
                        <img class="imagenperfil" src="<?php echo $datosusuario['foto_perfil'] ? $datosusuario['foto_perfil'] : 'fotosperfil/sinfotoperfil.jpg'; ?>" alt="Foto de perfil">
                    </div>
                    <div class="info-perfil">
                        <h2 class="nombre-usuario"><?php echo $datosusuario['nombres'] . " " . $datosusuario['apellidos']; ?></h2>
                        <p class="correo"><?php echo $datosusuario['correo']; ?></p>
                        <p class="estado-civil"><?php echo $datosusuario['estado_civil']; ?></p>
                    </div>
                </div>
            </section>
            <section class="publicaciones-section">
                <?php
                // Consulta para obtener todas las publicaciones ordenadas por fecha
                $consultaArticulos = $conn->query("SELECT * FROM articulos ORDER BY fecha_publicacion DESC");

                // Comprobar si hay artículos
                if ($consultaArticulos->rowCount() > 0) {
                    while ($articulo = $consultaArticulos->fetch()) {
                ?>
                <article class="publicacion">
                    <h3><?php echo $articulo['id_usuario']; ?></h3>
                    <?php if (isset($articulo['texto_articulo'])) : ?>
                        <p><?php echo $articulo['texto_articulo']; ?></p>
                    <?php else : ?>
                        <p>Contenido no disponible.</p>
                    <?php endif; ?>
                    <span>Fecha de publicación: <?php echo $articulo['fecha_publicacion']; ?></span>

                    <?php
                    // Verificar si hay una imagen almacenada en la base de datos
                    if (!empty($articulo['imagen_perfil'])) {
                        // Convertir los datos BLOB a una URL base64
                        $imagenURL = 'data:image/jpeg;base64,' . base64_encode($articulo['imagen_perfil']);
                    ?>
                    <img src="<?php echo $imagenURL; ?>" alt="Imagen del artículo">
                    <?php } ?>
                </article>
                <?php
                    }
                } else {
                    echo "<p>No hay artículos publicados.</p>";
                }
                ?>
            </section>
        </main>
    </div>
    <footer>
        <p>RedSocial - Tu red social personalizada</p>
    </footer>
</body>
</html>
