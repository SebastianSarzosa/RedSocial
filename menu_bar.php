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
</style>
<div class="contenedor" style="display: flex;justify-content: space-between;">
    <h1 class="logo">MiRedSocial</h1>
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