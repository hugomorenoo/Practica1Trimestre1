<?php
    session_start();
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                background-color: #0A2342;
                height: min(100vh);
                margin: 0px;
                padding: 0px;
                font-family:Arial, Helvetica, sans-serif;          
            }

            a{
                text-decoration: none;
            }

            .header{
                background-color: #D9DCD6;
                grid-area: "header";
                padding: 10px 0;
                width: 100%;
                display:flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                color: #010513;
            }

            .texto{
                padding-left: 1em;
                display:flex;
                flex-direction:row;
            }

            .logo img{
                width: 80px;
                height: 80px;
            }
            .logo{
                padding-left: 1em;
            }

            .texto h1{
                margin-left: 1em;
            }

            .navbar a {
                text-decoration: none;
                font-size: 18px;
                color: #010513;
                margin-right: 1em;
            }

            .navbar a:hover {
                border-bottom: 2px solid #00ccff;
            }

            .imagen{
                margin: auto;
                margin-top: 1em;
                display: flex;
                justify-content: center;
                align-items: center;
                height: auto;
                width: 700px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            }
            .imagen img{
                padding: 1em;
                max-width: 90%;
            }
        </style>
    </head>
    <?php
        try{
            require_once("ConectarBD.php");
            $bd = new ConectarBD();
            $conn = $bd->getConexion();
            $stmt = $conn->prepare("SELECT * FROM jugadores WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($jugador = $stmt->fetch()){
                $nombre = $jugador["nombre"];
                $src = "'../img/" . $jugador["nombre_imagen"] . "'";
            }
            if($stmt->rowCount() == 0 || !isset($_SESSION["usuario"])){
                header("Location: ../Login.php");
            }
        }catch(PDOException $ex){
            return "error: " . $ex->getMessage();
        }
    ?>
    <body>
        <div class="header">
            <div class="logo">
                <img src="../img/Artilleros.png">
            </div>
            <div class="texto">
                <h1><?php echo $nombre ?></h1>
            </div>
            <div class="navbar">
                <a href="../Welcome.php"> Volver </a>
                <a href="../Cerrar_sesion.php"> Cerrar sesión </a>
            </div>
        </div>
        <div class="imagen">
            <img src = <?php echo $src ?> >
        </div>
    </body>
</html>