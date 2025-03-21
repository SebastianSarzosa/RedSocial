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
        color: #545454;
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
        position: fixed;
        z-index: 10;
        width: 100%;
        background-color: #fff;
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
                <li>
                    <a class="navegacion__enlace" href="todosarticulos.php">Publicaciones</a>
                </li>
                <li>
                    <a class="navegacion__enlace" href="mensajesrecibidos.php">Mensajes</a>
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
