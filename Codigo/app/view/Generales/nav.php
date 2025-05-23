<style>

nav {
    background-color: rgb(104, 86, 52);
    color: white;
    width: 100vw;
    max-width: 100%;
    height: 60px;
    margin-top: 70px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    z-index: 1;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    height: 60px;
    min-height: 60px;
    font-family: 'Times New Roman', Times, serif;
    
}


a {
    text-decoration: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-right: 15px;
    margin-left: 10px;
    font-size: 22px;
}

a:hover {
    text-decoration: none;
    color: black;
}

a img {
    width: 24px;
    height: 24px;
    margin-right: 8px;
}

.logo {
    width: 10vw; 
    height: 10vw; 
    position: absolute;
    z-index: 10;
    top: 0px;
}

.opcionesUsuario {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 10;
}

.opcionesUsuario a,
.opcionesUsuario button {
    text-decoration: none;
    color: rgb(104, 86, 52);
    font-size: 20px;
    background: none;
    border: none;
    cursor: pointer;
}

.opcionesUsuario button:hover,
.opcionesUsuario a:hover {
    color: black;
}

.opcionesUsuario img {
    width: 20px;
    height: 20px;
}

#entrar{
    background-color: white;
    color:rgb(104, 86, 52);
    border-radius: 10px;
    padding: 1%;
    
}

#entrar:hover{

    transform: translateY(-5px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

@media (max-width: 700px) {
    nav a span {
        display: none;
    }

    nav a img {
        margin-right: 0; 
    }
}

</style>

<body>
    <!-- Opciones de usuario -->
    <div class="opcionesUsuario">
        <?php

    
        if ($nombre_usuario) {
            echo '<a href="cuenta.php"><img src="../Img/icons8-usuario-masculino-en-círculo-60.png" style="width: 40px; height: 40px; margin-right: 8px;">' . htmlspecialchars($nombre_usuario) . '</a>';

            if ($nombre_usuario === "admin") {
        ?>
                <!-- <a href="opcionesAdmin.php"><img src="../Img/icons8-llave-de-boca-50.png" style="width: 30px; height: 30px; margin-right: 8px;">Opciones de admin</a> -->
                <?php
            }
        } else {
            ?>
            <a href="login.php">Iniciar sesión</a>
        <?php
        }
        ?>
    </div>

    <nav>
    <a href="../PHP/inicio.php">
        <img src="../Img/icons8-casa-50.png" alt="Inicio">
        <span>Inicio</span>
    </a>
    <!-- <a href="../PHP/seleccion.php">
        <img src="../Img/icons8-producto-50.png" alt="Productos">
        <span>Servicios</span>
    </a> -->
    <a href="../PHP/paginaWishlist.php">
        <img src="../Img/icons8-estrella-50.png" alt="Deseados">
        <span>Precios</span>
    </a>
    <a href="../PHP/contacto.php">
        <img src="../Img/icons8-teléfono-50.png" alt="Contactanos">
        <span>Contactanos</span>
    </a>
    <a href="../PHP/negocio.php" id="entrar">
        <!-- <img src="../Img/icons8-teléfono-50.png" alt="Contactanos"> -->
        <span>Entrar</span>
    </a>

 
    
    <?php

// if($nombre_usuario == null){
// ?>
     <!-- <a style="display:none" href="../PHP/pedidos.php">
     <img src="../Img/icons8-camión-50.png" alt="Ped">
    <span>Pedidos</span>
    </a>
     <?php 
//     }else{
//         ?>
//      <a href="../PHP/pedidos.php">  
//     <img src="../Img/icons8-camión-50.png" alt="Ped">
//     <span>Pedidos</span>
//     </a>
   
//    <?php
// }
    ?>
    
    -->
</nav>
    


</body>
