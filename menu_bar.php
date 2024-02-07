<style>
    .logo{
        height: 50px;
    }
    ul{
        list-style: none;
        display: flex;
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
    .contenedor {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .navegacion ul ul {
        display: none;
        position: absolute;
        width: 200px;
        color: #fff;
    }
    .navegacion li:hover ul {
        display: block;
    }
    .header {
        padding: 10px 0;
        box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
    }
</style>
<header class="header">
    <div class="contenedor" style="display: flex;justify-content: space-between;">
        <a class="navegacion__enlace" href="inicio.php"><img src="fotosperfil/Logo con fondo.jpg" class="logo"></a>
        <nav class="navegacion">
            <ul>
                <li>
                    <a class="navegacion__enlace" href="inicio.php">Inicio</a>
                </li>
                <li style="width:170px;">
                    <a class="navegacion__enlace" href="todosarticulos.php">Publicaciones</a>
                    <ul style="padding:0; left: 48%;">
                        <li><a href="nuevoarticulo.php" class="navegacion__enlace">Crear un Publicacion </a></li>
                    </ul>
                </li>
                <li style="width:150px;">
                    <a class="navegacion__enlace" href="mensajesrecibidos.php">Mensajes</a>
                    <ul style="padding:0; left: 60%;">
                        <li><a href="" class="navegacion__enlace">Nuevo mensaje</a></li>
                        <li><a href="" class="navegacion__enlace">Menajes recividos</a></li>
                        <li><a href="" class="navegacion__enlace">Menajes enviados</a></li>
                    </ul>
                </li>
                <li>
                    <a class="navegacion__enlace" href="perfil.php">Perfil</a>
                </li>
                <li>
                    <a class="navegacion__enlace" href="amigos.php">Amigos</a>
                </li>
                <li>
                    <a class="navegacion__enlace--sesion" href="cerrarsesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
    </div>
</header>