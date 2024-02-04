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
    <title>Amigos</title> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet"> 
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
        
        .header8 { 
            background-color: #94c6d1; 
            padding: 10px 0; 
        } 
        
        .contenedor__titulo2 { 
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
        
        .registro { 
            margin-top: 20px; 
        } 
        
        .registro__titulo { 
            margin: 0; 
        } 
        
        .campos { 
            margin-bottom: 15px; 
        } 
        
        .inputEstilos { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-sizing: border-box; 
        } 
        
        .imageninicio { 
            max-width: 100%; 
        } 
        
        .boton { 
            background-color: #333; 
            color: #fff; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
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
    <header class="header8"> 
        <div class="contenedor"> 
            <div class="contenedor__titulo2"> 
                <h1 class="no-margin centrar-texto">Amigos</h1> 
            </div> 
            <nav class="navegacion"> 
                <a class="navegacion__enlace" href="inicio.php"> inicio </a> 
            </nav> 
        </div> 
    </header> 
    <div class="contenedor"> 
        <br> 
        <div> 
            <center><a class="boton" type="submit" href="buscaramigos.php">Quieres buscar un nuevo amigo?</a></center> 
        </div>  
        <br>  
        <main> 
            <center><h3>Mis Amigos</h3></center> 
            <hr> 
            <br> 
            <div> 
                <?php 
                    
                    $consultaamigos = $conn -> query("select * from usuarios"); 
                    $contador = $consultaamigos->rowcount(); 
                    if ($contador > 0){  
                        while($datosamigos = $consultaamigos->fetch()){    
                            $id = $datosamigos['id_usuario']; 
                            $revisionamigo = $conn -> query("SELECT id_relacion_amistad, id_usuario,  
                            id_amigo_usuario FROM amistades WHERE id_usuario = '$session_id'  
                            AND id_amigo_usuario = '$id' OR id_usuario = '$id'  
                            AND id_amigo_usuario = '$session_id'"); 
                            $datosamistad = $revisionamigo->fetch(); 
                            if($datosamistad != null){ 
                    
                ?> 
                <br> 
                <form class="formulariobuscandoamiguis" action="eliminaramigo.php" method="POST" autocomplete="on" enctype="multipart/form-data"> 
                    
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
                                <center><input class="boton" type="submit" value="Eliminar Amigo(a)"></center> 
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
                        <input type="hidden" name="_csrf" value="<?php echo $_SESSION['AntiCSRF']; ?>">          
                    </div> 
                </form>  
                <br> 
                <hr>   
                <?php 
                        } 
                    } 
                } 

                ?>  
            </div> 
        </main> 
    </div> 
    <br> 
    <br> 
</body> 
</html>
