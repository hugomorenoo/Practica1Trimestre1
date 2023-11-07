<?php
    session_start();
    $err = "";
    if(empty($_POST["nombre"]) || empty($_POST["posicion"]) || empty($_POST["valor"])){
        $err .= "Debes de rellenar todos los campos.";
    }
    if(!is_string($_POST["nombre"]) || !is_string($_POST["posicion"]) || !is_numeric($_POST["goles"]) || !is_numeric($_POST["valor"])){
        $err .= "Los tipos de datos no son correctos.";
    }
    if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){
        if($_FILES["imagen"]["size"] > 65535){
            $err .= " Archivo demasiado grande.";
        }
        if($_FILES["imagen"]["type"] == "image/png"){
            $tipo = ".png";
        } else if ($_FILES["imagen"]["type"] == "image/jpeg"){
            $tipo = ".jpg";
        }else{
            $err .= " Solo se permiten archivos jpg o png ";
        }
    }else{
        echo "no subida";
    }
    if($err == ""){
        $nombre = $_POST["nombre"];
        $pos = $_POST["posicion"]; 
        $goles = $_POST["goles"]; 
        $valor = $_POST["valor"];
        $imgblob = $_FILES["imagen"]["tmp_name"];
        $img = $nombre . $tipo;
        $ruta = "img/" . $img;
        move_uploaded_file($imgblob,$ruta);
        echo "subida";
        try{
            require_once("ConectarBD.php");
            $bd = new ConectarBD();
            $conn = $bd->getConexion();
            $fp = fopen($ruta, 'rb');
            $stmt = $conn->prepare("INSERT INTO jugadores (nombre, valor, posición, goles, nombre_imagen, imagen) VALUES (:nombre,:valor,:pos,:goles,:img1,:img2)");
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":valor", $valor);
            $stmt->bindParam(":pos", $pos);
            $stmt->bindParam(":goles", $goles);
            $stmt->bindParam(":img1", $img);
            $stmt->bindParam(":img2", $fp, PDO::PARAM_LOB);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo $stmt->rowCount();
            if($stmt->rowCount() > 0){
                header("location: Welcome.php");
            } else{
                $err .= "No hay filas actualizadas";
            }
        }catch(PDOException $ex){
            return "error: " . $ex->getMessage();
        } 
    }else{
        $_SESSION["err"] = $err;
        header("location: Welcome.php");
    }
?>