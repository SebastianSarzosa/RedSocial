<style>
    .logo{
        display: inline;
        margin: 0;
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
</style>
<div class="contenedor" style="display: flex;justify-content: space-between;">
    <h1 class="logo">MiRedSocial</h1>
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