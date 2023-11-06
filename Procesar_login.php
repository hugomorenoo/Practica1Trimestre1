<?php
    session_start();
    require_once "ConectarBD.php";
    $bd = new ConectarBD();
    $conn = $bd->getConexion();
    $err ="";      
    if(!empty($_POST["usuario"]) && !empty($_POST["contraseña"])){
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["contraseña"] = $_POST["contraseña"];
        try{
            $stmt = $conn->prepare('SELECT * FROM usuarios WHERE usuario = :usuario AND contraseña = :pass');
            $stmt->bindValue(":usuario", $_SESSION["usuario"]);
            $stmt->bindValue(":pass", $_SESSION["contraseña"]);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
                while($user = $stmt->fetch()){
                    if($user["rol"] == "admin"){
                        $_SESSION["rol"] = "administrador";
                    }else{
                        $_SESSION["rol"] = "invitado";
                    }
                    header("location: Welcome.php");
                }
            } else{
                $err = "Datos incorrectos";
            }
        }catch (PDOException $ex){
            echo "error: " . $ex->getMessage();
        };
    } else{
        $err = "Debe introducir todos los datos";
    }
    if($err != ""){
        $_SESSION["err"] = $err;
        header("location: Login.php");
    }
    $bd->cerrarConexion();
?>