<?php session_start(); 
    if(!isset($_SESSION["usuario"]) || !isset($_SESSION["contraseña"]) || !isset($_SESSION["rol"])){
        header("location: Login.php");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    </head>
    <body>
        <div class="header">
            <div class="texto">
                <img src="img/Artilleros.png">
                <h1><?php echo "Hola " . $_SESSION["usuario"] . ", eres " . $_SESSION["rol"]; ?></h1>
            </div>
            <div class="navbar">
                <a href="Cerrar_sesion.php"> Cerrar sesión </a>
            </div>
        </div>
        <div class="contenido">
            <?php
                if($_SESSION["rol"] == "administrador"){
                    echo "<div class='form'>";
                    if(isset($_SESSION["err"]) && $_SESSION["err"] != ""){
                        echo "
                        <div id='error'>
                            <p>" . $_SESSION["err"] . "<p>
                        </div>
                        ";
                        $_SESSION["err"] = "";
                    }
                    echo "
                        <h2>Añadir posible fichaje</h2>
                        <form action='Alta.php' method='post' enctype='multipart/form-data'>
                            <label for='nombre'>Nombre:</label>
                            <input type='text' id='nombre' name='nombre' required>
                            <br>
                    
                            <label for='valor_mercado'>Valor de Mercado (en millones de euros):</label>
                            <input type='float' id='valor_mercado' name='valor' required>
                            <br>
                    
                            <label for='posicion'>Posición:</label>
                            <input type='text' id='posicion' name='posicion' required>
                            <br>
                    
                            <label for='goles'>Goles:</label>
                            <input type='number' id='goles' name='goles' required>
                            <br>
                    
                            <label for='imagen'>Imagen del Jugador:</label>
                            <input type='file' id='imagen' name='imagen'>
                            <br>

                            <div id='previsualizado'>
                                <img id='foto'>
                            </div>
                    
                            <input type='submit' value='Enviar'>
                        </form>
                    </div>
                    ";
                }
            ?>
            <div class="table">
                <table border="1">
                    <thead>
                        <th> Nombre </th>
                        <th> Valor de mercado </th>
                        <th> Posición </th>
                        <th> Goles </th>
                        <th> Imagen</th>
                        <th> Imagen Blob </th>
                        <th> Acciones </th>
                    </thead>
                    <?php
                        try{
                            require_once("ConectarBD.php");
                            $bd = new ConectarBD();
                            $conn = $bd->getConexion();
                            $stmt = $conn->prepare("SELECT * FROM jugadores");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while($jugador = $stmt->fetch()){
                                $salida = "<tr>";
                                foreach($jugador as $key => $value){
                                    if($value == null){
                                        if($key == "imagen"){
                                            $salida .= "<td> No hay imagen Blob </td>";
                                        } else if ($key == "goles"){
                                            $salida .= "<td> 0 </td>";
                                        }
                                    } else{
                                        if($key != "id"){
                                            if($key == "nombre_imagen"){
                                                $salida .=  "<td> <img src='img/" . $value . "' height=70px width=70px> </td>";
                                            } else if ($key == "imagen"){
                                                $salida .=  "<td> <img src='data:image/jpeg;base64," . base64_encode($value). "' height=70px width=70px></td>";
                                            }else if($key == "valor"){
                                                $salida .=  "<td>" . $value . "M €</td>";
                                            } else{
                                                $salida .=  "<td>" . $value . "</td>";
                                            }
                                        }
                                    }
                                }
                                $salida .= "<td> <a href='Jugador/" . $jugador["id"] . "'> <button id='detalles'>  Detalles </button></a></td>";
                                $salida .= "</tr>";
                                echo $salida;
                            }
                        }catch(PDOException $ex){
                            return "error: " . $ex->getMessage();
                        }
                    ?>
                </table>
            </div>
        </div>
        <script>
            var imagen = document.getElementById('imagen');
            imagen.onchange = function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("foto").src = e.target.result;
                    document.getElementById("foto").style.display = "block";
                };
                reader.readAsDataURL(this.files[0]);
            };
        </script>
    </body>
</html>