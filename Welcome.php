<?php session_start(); 
    if(!isset($_SESSION["usuario"]) || !isset($_SESSION["contraseña"]) || !isset($_SESSION["rol"])){
        header("location: Login.php");
    }

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

.texto img{
    width: 80px;
    height: 80px;
}

.texto h1{
    margin-left: 1em;
}

.navbar {
    padding-right: 2em;
}

.navbar a {
    text-decoration: none;
    font-size: 18px;
    color: #010513;
}

.navbar a:hover {
    border-bottom: 2px solid #00ccff;
}
.contenido{
    display:flex;
    margin-top: 1em;
    justify-content: center;
    align-items: left;
    flex-direction: row;
    width: 100%;
}
.form {
    width: 33%;
    height:100%;
    background-color: #D9DCD6;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
    margin: 0 20px;
}
#error {
    margin-top: 0.75em;
    background-color: #af2917;
    height: 30px;
    width: 100%;
    border-radius: 10px;
    display:flex;
    align-items: center;
    justify-content: center;
}

#error p {
    padding: 0.5em;
    color: #ffff;
    font-size: 14px;
}

.form h2 {
    color: #333;
}

.form label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

.form input[type="text"],
.form input[type="number"],
.form input[type="float"]{
    background-color: #F5FDC6;
    width: 90%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form input[type="file"] {
    width: 90%;
    margin-top: 5px;
}

.form input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    margin-top:1em;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.form input[type="submit"]:hover {
    background-color: #0056b3;
}

#previsualizado{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1em;
}

#foto{
    height: 100px;
    width: 100px;
    display:none;
}

.table{
    display:flex;
    justify-content: center;
    align-items: center;
    width: 70%;
    height: 20%;
    padding: 0 1em;
    margin-bottom: 20px;
}

.imagen{
    height: 10px;
    width: 10px;
}

table {
    border-collapse: collapse;
    width: 100%;
    box-shadow: 4px 4px 8px #888888;
    height: 100%;
    background-color: #E1DEFF;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: center;
}

th{
    font-size: 1.4em;
    border:none;
}

thead {
    background-color: #1E1A1D;
    color: white;
}

button{
    padding: 0.75em;
    width: 100%;
    border-radius: 8px;
    color: white;
    border:none;
    width: 70%;
    font-weight: bold;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

#detalles{
    background-color: blue;
}

#detalles:hover{
    background-color: black;
    color: blue;
}

#descarga{
    background-color: white;
    color: blue;
}

#descarga:hover{
    background-color: black;
    color: white;
}
        </style>
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
                                $salida .= "
                                <td> 
                                    <a href='Jugador/" . $jugador["id"] . "'> <button id='detalles'>  Detalles </button></a>
                                    <a href='img/" . $jugador["nombre_imagen"] . "' download=' " . $jugador["nombre_imagen"] . "'> 
                                        <button id='descarga'>  Descargar </button>
                                    </a>
                                </td>";
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