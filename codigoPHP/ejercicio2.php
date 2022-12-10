<?php
/**
* Ejercicio 2
* @author: Luis Pérez Astorga
<<<<<<< HEAD:codigoPHP/ejercicio2.php
* @version: 1.1
* @since 05/12/2022
=======
* @version: 1.0
* @since 2/12/2022
>>>>>>> b52aee6d335675e6aa77c20e624b9bd1043b9885:codigo/ejercicio2.php
*/
//Recorrido con un foreach la variable superglobal $_SERVER
require_once '../config/confConexion.php';
require_once '../core/221024ValidacionFormularios.php';
/**
 * existUser
 * Nos permite comprobar si existe el usuario dentro de la tabla T02_Usuario
 * @param  String $usuario Usuario que vamos a comprobar que exista.
 * @param  String $password Contraseña que del usuario.
 * @return bool Devuelve true si existe y false si no.
 */
function existUser(String $usuario, String $password){
    if(!empty(validacionFormularios::comprobarAlfabetico($usuario,200,1,1)) && !empty(validacionFormularios::comprobarAlfabetico($password,200,1,1))){
        return false;
    }
    try{
        $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
        $oQuery=$odbDepartamentos->prepare('select CodUsuario from T02_Usuario where CodUsuario=? and Password=SHA2(concat(?,?),256)');
        $oQuery->bindParam(1,$usuario);
        $oQuery->bindParam(2,$usuario);
        $oQuery->bindParam(3,$password);
        $oQuery->execute();
        if($oQuery->rowCount()>0){
            return true;
        }
    } catch (PDOException $th) {
        print $th->getMessage();
    }finally{
        unset($odbDepartamentos);
    }
    return false;
}


while(!isset($_SERVER['PHP_AUTH_USER']) || !existUser($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'])){
    header('WWW-Authenticate: Basic realm="localhost"');
    exit();
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
    <title>Ejercicio02</title>
</head>
<body>
    <header>
    <h1>2. Desarrollo de un control de acceso con identificación del usuario basado en la función header() y en el uso de una tabla “Usuario” de la base de datos. (PDO).</h1>
    </header>
    <section>
        <article>
            <?php
                session_start();
                $user=preg_replace("/[-'\s\"]+/s","",$_SERVER['PHP_AUTH_USER']);
                ?> <p><?php print "Bienvenido ".$_SERVER['PHP_AUTH_USER'];?></p> <?php
                try {
                    $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
                    if(!isset($_SESSION['userPoryectoDAW'])){
                        $horaConexion=time();
                        $oQuery=$odbDepartamentos->prepare('update T02_Usuario set NumConexiones=NumConexiones+1 where CodUsuario=?');
                        $oQuery->bindParam(1,$user);
                        $oQuery->execute();
                        $odbDepartamentos->prepare('update T02_Usuario set FechaHoraUltimaConexion=? where CodUsuario=?');
                        $oQuery->bindParam(1,$horaConexion);
                        $oQuery->bindParam(2,$_REQUEST['usuario']);
                        $oQuery->execute();
                    }
                    $oQuery=$odbDepartamentos->prepare('select NumConexiones, FechaHoraUltimaConexion from T02_Usuario where CodUsuario=?');
                    $oQuery->bindParam(1,$user);
                    $oQuery->execute();
                    $resultado=$oQuery->fetchObject();
                    if($resultado->NumConexiones==1){
                        print('Es tu primera conexion');
                    }else{
                        printf('Se a conectado %d <br>',$resultado->NumConexiones);
                        printf('La ultima conexion fue en %s',date('d-m-Y',$resultado->FechaHoraUltimaConexion));
                    }
                } catch (PDOException $th) {
                    print $th->getMessage();
                }finally{
                    unset($odbDepartamentos);
                }
                $_SESSION['userPoryectoDAW']=$_SERVER['PHP_AUTH_USER'];
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