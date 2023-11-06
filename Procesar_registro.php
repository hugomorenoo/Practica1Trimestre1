<?php
    session_start();
    require_once "ConectarBD.php";
    $bd = new ConectarBD();
    $conn = $bd->getConexion();
    $err ="";
    if($_POST["nuevaContraseña"] != $_POST["contraseñaRep"]){
        $err .= "Las contraseñas deben de ser iguales";
    }      
    if(empty($_POST["nuevoUsuario"]) || empty($_POST["nuevaContraseña"]) || empty($_POST["contraseñaRep"])){
        $_err .= " Debe de rellenar todos los datos";
    }
    if($err == ""){
        try{
            $stmt = $conn->prepare("INSERT into usuarios VALUES(:usuario,:pass, 'invitado')");
            $stmt->bindValue(":usuario", $_POST["nuevoUsuario"]);
            $stmt->bindValue(":pass",$_POST["nuevaContraseña"]);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                header("location: Login.php");
            }else{
                $_SESSION["err"] .= "Error al registrarse";
            }
        }catch (PDOException $ex){
            echo "error: " . $ex->getMessage();
        }
    } else{
        $_SESSION["err"] = $err;
        header("location: Registro.php");
    }
    $bd->cerrarConexion();
?>