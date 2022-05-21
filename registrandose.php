<?php

include ('conexion.php');

//se llama el metodo para mostrar los errores
//MostrarErrores();

//Llama la limpieza de datos
//con esto ya llama la limpieza de datos?
$_POST = LimpiarEntradas($_POST);
//LimpiarEntradas();

    if ($_POST['clave'] == $_POST['confirmarclave']) {
        $consultausuario = $conn->prepare("SELECT nombre_usuario FROM usuarios where nombre_usuario = :nombre_usuario");
        $consultausuario -> bindParam(':nombre_usuario', $_POST['nombre_usuario']);
        //$consultausuario->execute();
        try {
            if ($consultausuario->execute()) {
                $comparacion = $consultausuario->fetch();
            }
        } catch (Exception $e) {
            $e->getMessage();
            echo "<script> alert('Usuario ya existe'); window.location = 'index.php'; </script>";
        }
        //$comparacion = $consultausuario->fetch();
        //comprueba que el usuario ya existe
        if ($comparacion == null) {
            // mysql_num_rows <- esta funcion me imprime el numero de registro que encontro 
            // si el numero es igual a 0 es porque el registro no exite, en otras palabras ese user 
            // no esta en la tabla miembro por lo tanto se puede registrar
            //se llama la conexion y se hace la consulta
            /*$Insertstmt = $conn->prepare ("INSERT INTO `usuarios`(`nombres`, `apellidos`, `correo`, 
                            `fecha_nacimiento`,`cedula`, `cantidad_hijos`, `estado_civil`, `nombre_usuario`, `clave`) 
                            VALUES (':nombres',':apellidos',':correo',':fecha_nacimiento',':cedula',
                            ':cantidad_hijos',':estado_civil',':nombre_usuario',':clave')");*/

            // es mejor hacer las consultas insert con set y sin comillas 

            $Insertarstmt = $conn->prepare ("INSERT INTO usuarios SET nombres=:nombres, apellidos=:apellidos, correo=:correo, 
            fecha_nacimiento=:fecha_nacimiento, cedula=:cedula, cantidad_hijos=:cantidad_hijos, 
            estado_civil=:estado_civil, nombre_usuario=:nombre_usuario, clave=:clave");

            
            $Insertarstmt -> bindParam(':nombres', $_POST['nombres']);
            $Insertarstmt -> bindParam(':apellidos', $_POST['apellidos']);
            $Insertarstmt -> bindParam(':correo', $_POST['correo']);
            $Insertarstmt -> bindParam(':fecha_nacimiento', $_POST['fecha_nacimiento']);
            $Insertarstmt -> bindParam(':cedula', $_POST['cedula']);
            $Insertarstmt -> bindParam(':cantidad_hijos', $_POST['cantidad_hijos']);
            $Insertarstmt -> bindParam(':estado_civil', $_POST['estado_civil']);
            $Insertarstmt -> bindParam(':nombre_usuario', $_POST['nombre_usuario']);
            $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
            $Insertarstmt -> bindParam(':clave', $clave);
                try {
                    if ($Insertarstmt->execute()) {
                        //echo "<script> alert('Registro satisfactorio, ingresa con tus credenciales'); window.location = 'index.php'; </script>";
                        header('location:ingresando.php');
                    }
                } catch (Exception $e) {
                    $e->getMessage();
                    //echo "<script> alert('Disculpe, el usuario no se ha podido crear'); window.location = 'index.php'; </script>";
                    header('location:index.php');
                    die();
                }
                
            
    
        } else {
            //echo "<script> alert('Usuario ya existe'); window.location = 'index.php'; </script>";
            header('location:index.php');
        }
        
    } else {
    //echo "<script> alert('Contraseñas no son iguales'); window.location = 'registro.php'; </script>";
    header('location:registro.php');
    }

?>