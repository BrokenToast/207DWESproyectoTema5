<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/tabla.css">
    <link rel="stylesheet" href="../webroot/style/ejercicios/ejercicio0.css">
    <title>Ejercicio0</title>
</head>
<body>
    <header>
    <h1>0. Mostrar el contenido de las variables superglobales y phpinfo().</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * Ejercicio 0
                * @author: Luis Pérez Astorga
                * @version: 1.0
                * @since 2/12/2022
                */
                //Recorrido con un foreach la variable superglobal $_SERVER
                session_start();
                ?>
                 <div id=super>
                    <?php
                    //Delcaración de un array con todas las superglobales
                    $aVairablesSuper=[
                        "_SESSION"=>$_SESSION?? array(),
                        "GLOBALS"=>$GLOBALS,
                        "_SERVER"=>$_SERVER,
                        "_GET"=>$_GET,
                        "_POST"=>$_POST,
                        "_FILES"=>$_FILES,
                        "_REQUEST"=>$_REQUEST,
                        "_ENV"=>$_ENV,
                        "_COOKIE"=>$_COOKIE];
                    // Recorremos el  la array de SuperGlobales y la imprimimos como tablas;
                    foreach($aVairablesSuper as $nomVariable=>$aVariableSuper ){
                        if ($nomVariable=="_SESION") {
                            $varSesion=false;
                        }
                        //En caso de que la SuperGlobal este vaica muesta esta tabla;
                        if(empty($aVariableSuper)){
                            ?>
                            <table>
                                <tr>
                                    <th><?php print $nomVariable; ?></th>
                                </tr>
                                <tr>
                                    <td>Esta vacia</td>
                                </tr>
                            </table> 
                            <?php
                        }else{
                        // En caso de que no este vacia muestra el contenido como en una tabla
                        ?><table>
                            <tr>
                                <th colspan="2"><?php print $nomVariable; ?></th>
                            </tr>
                            <tr>
                                <th>Clave </th>
                                <th>Valor</th>
                            </tr>
                            <?php 
                                foreach($aVariableSuper as $clave=>$valor){
                                    ?>  
                                    <tr>
                                        <td><?php print $clave; ?></td>
                                        <td><?php print_r($valor); ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </table> 
                    <?php
                        }
                    }
                    ?>
                </div>
            <?php phpinfo() ?>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../../../index.html"><img src="../../../doc/logo_Casa.png" alt="Pagina creador"></a>
            <a href="../index.php"><img src="../../../doc/atras.svg" alt="Atras"/></a>
    </footer>
</body>
</html>