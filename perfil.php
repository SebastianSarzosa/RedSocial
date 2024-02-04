<?php
include('conexion.php');
include('sesion.php');
require_once 'funciones.php';

if (isset($_POST['btnAccion'])) {
    AntiCSRF();
}
GenerarAnctiCSRF();
$sql = $conn->query("SELECT nombres, apellidos, correo, registro_usu, foto_perfil FROM usuarios WHERE id_usuario='$session_id'");
while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style_perfil.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('menu-bar.php'); ?>
    <div class="container">
        <div class="portada">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $carpetaDestino = '';
                    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
                        $archivoOrigen = $_FILES["archivo"]["tmp_name"];
                        $nombreArchivo = basename($_FILES["archivo"]["name"]);
                        $rutaDestino = $carpetaDestino . $nombreArchivo;
                        if (move_uploaded_file($archivoOrigen, $rutaDestino)) {
                            echo 'Archivo copiado con éxito.';
                        } else {
                            echo 'Error al copiar el archivo.';
                        }
                    } else {
                        echo 'No se ha seleccionado un archivo o ha ocurrido un error durante la carga.';
                    }
                }
                ?>    
  
        </div>            
        <div>
            <input type="file" id="imagen" name="imagen" accept="image/*" style="display: none;" onchange="mostrarImagen(this)">
            <button type="button" onclick="document.getElementById('imagen').click()" class="subirImagen">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                </svg>Editar portada
            </button>
        </div>    
        <div class="estadistica">
            <div class="estadistica__">
                <h1>hola mundo</h1>
            </div>
        </div>
        <div class="foto_perfil">
            <img src="fotosperfil/<?php echo $row->foto_perfil;?>" alt="Image did not load..." class="img">            
        </div>
        <div class="inf">
            <div class="informacion">
                <div class="informacion__">
                    <?php
                        $nombre = $row->nombres . " " . $row->apellidos;
                            echo "<h2>" . $row->nombres . " " . $row->apellidos . "</h2><br>";
                            echo "<p>Se unió " . $row->registro_usu . "</p>";
                        }
                    ?>
                    <div class="button">
                        <div id="publicar">Publicar</div>
                        <div id="mensaje">Mensaje</div>
                    </div>
                </div>
            </div>
            <div class="publicaciones">
                <?php
                    $consultaArticulos = $conn->query("SELECT * FROM articulos Where id_usuario = $session_id ORDER BY fecha_publicacion DESC");
                    while ($articulo = $consultaArticulos->fetch(PDO::FETCH_OBJ)) {
                ?>
                <article class="publicacion" style="width: 540px;">
                    <h3><?php echo $nombre; ?></h3>
                    <?php if (isset($articulo->texto_articulo)) : ?>
                        <p><?php echo $articulo->texto_articulo; ?></p><?php else : ?>
                            <p>Contenido no disponible.</p>
                            <?php endif; ?>
                            <span>Fecha de publicación: <?php echo $articulo->fecha_publicacion; ?></span>
                            <?php
                                if (!empty($articulo->imagen_perfil)) {
                                $imagenURL = 'data:image/jpeg;base64,' . base64_encode($articulo->imagen_perfil);
                            ?>
                            <img src="<?php echo $imagenURL; ?>" alt="Imagen del artículo">
                    <?php } ?>
                </article> 
                <?php
                }
                ?>            
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>

</html>
