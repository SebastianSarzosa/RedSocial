<?php 
include('conexion.php'); 
include('sesion.php');
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
            border-radius: 50%; /* Añadido para la imagen de perfil */
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
        /* Estilos adicionales para el formulario */
.formularioarticulitos {
    background-color: #f3f3f3;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.contenedordatos {
    display: flex;
    align-items: center;
}

.sidebar {
    flex: 1;
}

.camposdaticos {
    flex: 2;
}

.campos {
    margin-bottom: 10px;
}

.imageninicio {
    max-width: 100px;
    border-radius: 50%;
}

.botones {
    display: flex;
    justify-content: center;
}

.boton, .boton_a {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 10px;
}

.boton {
    background-color: #4CAF50;
    color: white;
}

.boton_a {
    background-color: #f44336;
    color: white;
    cursor: not-allowed;
}

.camposdaticos label {
    font-weight: bold;
    margin-right: 10px;
}

.camposdaticos p {
    margin: 0;
}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="contenedor">
            <h1 class="logo">MiRedSocial</h1>
            <nav class="navegacion">
                <a class="navegacion__enlace" href="inicio.php"> Inicio </a>
            
                <a class="navegacion__enlace" href="nuevoarticulo.php"> Crear un Publicacion </a>
                <a class="navegacion__enlace--sesion" href="cerrarsesion.php">Cerrar Sesión</a>
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
                $consultapublicacion = $conn->query("SELECT articulos.id_articulo,  articulos.texto_articulo,
                articulos.fecha_publicacion, articulos.articulo_privado,
                usuarios.id_usuario, usuarios.nombres, usuarios.apellidos, usuarios.cedula, 
                usuarios.correo, usuarios.foto_perfil FROM articulos
                INNER JOIN usuarios ON usuarios.id_usuario = articulos.id_usuario
                WHERE articulos.articulo_privado = 'off'
                ORDER BY articulos.id_articulo DESC");
                $contador = $consultapublicacion->rowcount();
                if ($contador > 0) {
                    while ($datospublicacion = $consultapublicacion->fetch()) {

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
                                <?php if ($datospublicacion['foto_perfil'] != null) {
                                    ?><img class="imageninicio" src="<?php echo $datospublicacion['foto_perfil']; ?>"><?php
                                    } else {
                                    ?><img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg"><?php
                                } ?>
                            </div>

                            <?php

                            if ($datospublicacion['id_usuario'] == $session_id) {

                            ?>
                            <br>
                            <br>
                            <br>
                            <br>
                            
                                <div class="botones">
                                    <input class="boton" name="eliminar" type="submit" value="Eliminar Publicación">
                                </div>
                            <?php

                            } else {

                            ?>
                                <div class="botones">
                                    <input name="id_articulo" type="hidden" value="<?php echo $datospublicacion['id_articulo']; ?>">
                                    <input class="boton_a" type="text" value="No se puede Eliminar" readonly>
                                </div>
                            <?php

                            }

                            ?>
                            <br>
                            <div class="botones">
                                <?php

                                $revisionamigo = $conn->query("SELECT id_articulo, id_usuario, 
                                texto_articulo, articulo_privado, fecha_publicacion 
                                FROM articulos WHERE id_usuario = '$session_id' and id_articulo = $id");
                                $datosamistad = $revisionamigo->fetch();
                                if ($datosamistad != null) {

                                ?>
                                    <input class="boton" name="cambiecito" type="submit" value="Cambiar a Privado">

                                <?php

                                } else {

                                ?>
                                    <input class="boton_a" type="text" value="No lo puedes cambiar" readonly>
                                <?php

                                }

                                ?>
                            </div>
                                <br>
                        </aside>
                        <div class="camposdaticos">
                            <div>
                                <label for="input01">Nombre Completo: </label>
                                <p class="datosusuario"><?php echo $datospublicacion['nombres'] . " " . $datospublicacion['apellidos']; ?></p>
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
        <?php
    if ($datospublicacion['foto_perfil'] != null) {
        $ruta_imagen = $datospublicacion['foto_perfil'];
        echo "Ruta de la imagen: " . $ruta_imagen;
        ?><img class="imageninicio" src="<?php echo $ruta_imagen; ?>"><?php
    } else {
        echo "No se ha especificado una imagen de perfil.";
    }
?>

            </div>
        </main>
    </div>
</body>
</html>
