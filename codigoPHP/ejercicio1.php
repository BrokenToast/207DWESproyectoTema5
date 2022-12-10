<?php
    while(!isset($_SERVER['PHP_AUTH_USER'])|| $_SERVER['PHP_AUTH_PW']!="paso" || $_SERVER['PHP_AUTH_USER']!="admin"){
        header('WWW-Authenticate: Basic realm="localhost"');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/tabla.css">
    <link rel="stylesheet" href="../webroot/style/ejercicios/ejercicio0.css">
    <title>Ejercicio01</title>
</head>
<body>
    <header>
    <h1>1. Desarrollo de un control de acceso con identificación del usuario basado en la función header().</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * Ejercicio 1
                * @author: Luis Pérez Astorga
                * @version: 1.0
                * @since 2/12/2022 
                */
                //Recorrido con un foreach la variable superglobal $_SERVER
                session_start();
                ?> <p><?php print "Bienvenido ".$_SERVER['PHP_AUTH_USER'];?></p> <?php
            ?>
            </div>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../../../index.html"><img src="../../../doc/logo_Casa.png" alt="Pagina creador"></a>
            <a href="../index.php"><img src="../../../doc/atras.svg" alt="Atras"/></a>
    </footer>
</body>
</html>