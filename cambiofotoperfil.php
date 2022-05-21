<?php

include('conexion.php');
include('sesion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//con esto ya llama la limpieza de datos?
//LimpiarEntradas();
$_POST = LimpiarEntradas($_POST);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FotodePerfil</title>
    <link rel="stylesheet" href="css/normalice.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header7">
        <div class="contenedor">
            <div class="contenedor__titulo2">
                <h1 class="no-margin centrar-texto">Foto de Perfil</h1>
            </div>
            <nav class="navegacion">
                <a class="navegacion__enlace1" href="perfil.php"> Perfil </a>
            </nav>
        </div>
    </header>
    <div class="contenedor">
        <main>
            <center><h2>Zona de Actualización Foto de Perfil Usuario</h2></center>
            <form class="formulariofotoperfil" method="POST" enctype="multipart/form-data">
                <div>
                    <?php
                    $consultadatospersonales = $conn->query("select * from usuarios where id_usuario = '$session_id'");
                    $datosusuario = $consultadatospersonales->fetch();
                    $id = $datosusuario['id_usuario'];
                    ?>
                    <div class="campos">
                        <center><label for="img">Foto de perfil: </label></center>
                        <?php if($datosusuario['foto_perfil'] != null){
                            ?> <center><img class="imageninicio" src="<?php echo $image; ?>" height="220" width="260"></center> <?php
                        } else {
                            ?> <center><img class="imageninicio" src="fotosperfil/sinfotoperfil.jpg" height="220" width="260"></center> <?php
                        } ?>
                    </div>
                    <div>
                        <center><input class="estiloinput campofile" name="image" type="file" required></center>
                    </div>
                </div>
                <div>
                    <center><button class="boton" name="fotoperfil" type="submit">Actualizar Datos</button></center>
                </div> 
            </form>
            <?php
            

            if(isset($_POST['fotoperfil'])) {
                if (isset($_FILES['image'])) {
                    

                    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                    $image_name = $_FILES['image']['name'];
                    $image_size = $_FILES['image']['size'];
                    $image_type = $_FILES['image']['type'];
                    $imageNameCmps = explode(".", $image_name);
                    $imageExtension = strtolower(end($imageNameCmps));//asegura que el nombre sea un archivo aceptable
                    $newFileName = md5(time() . $image_name) . '.' . $imageExtension; //evalua el nombre
                    $allowedimageExtensions = array('jpg', 'gif', 'png', 'jpeg'); // solo permite estas entradas de imagenes o extensiones
                    if (in_array($imageExtension, $allowedimageExtensions)) {

                        // directory in which the uploaded file will be moved
                        $uploadFileDir = 'archivoscorruptos/'; // mueve el archivo corrupto aqui
                        if (!file_exists($uploadFileDir)) {
                            mkdir($uploadFileDir);
                        }
                        move_uploaded_file($_FILES["image"]["tmp_name"], "fotosperfil/" . $_FILES["image"]["name"]);
                        $location = "fotosperfil/" . $_FILES["image"]["name"];
                        
                        /*echo "<br>Exif Antes<br>";
                        $exif2 = exif_read_data($location);
                        var_dump($exif2);

                        $path = ($location);
                        $img = imagecreatefromjpeg($path);
                        imagejpeg ($img, $path, 100);
                        imagedestroy ($img);

                        echo "<br>Exif Después<br>";
                        $exif2 = exif_read_data($location);
                        var_dump($exif2);*/
                        //$locatio = 'null';
                        //removeExif($location, $locatio);

                        $conn->query("UPDATE usuarios set foto_perfil = '$location' where id_usuario = '$id'");

                        echo "<script> alert('Se pudo subir de manera satisfactoria'); window.location = 'perfil.php'; </script>";

                    }else{
                        echo "<script> alert('Imagen de perfil corrupta no se puede subir de manera satisfactoria'); window.location = 'perfil.php'; </script>";
                    }

                }
                
            }
            ?>
            <br>
        </main>
    </div>
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


