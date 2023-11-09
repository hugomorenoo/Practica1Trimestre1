<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display:flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        
        .title{
            padding-left: 1em;
            display:flex;
            flex-direction:row;
            align-items: center;
        }

        .title img{
            width: 50px;
            height: 50px;
        }

        h2 {
            color: #333;
            margin-left: 0.5em;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        #registro{
            margin-top: 0.75em;
        }

        #registro a{
            color: purple;
            font-size: 0.80em;
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

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php
            if(isset($_SESSION["err"])){
                echo "
                    <div id='error'>
                        <p>" . $_SESSION["err"] . "</p>
                    </div>
                ";
                session_unset();
            }
        ?>
        <div class="title">
            <img src="img/Artilleros.png">
            <h2>Iniciar Sesión</h2>
        </div>
        <form action="Procesar_login.php" method="post">
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <div id="registro">
            <a href="Registro.php"> ¿No tienes cuenta? Regístrate </a>
        </div>
    </div>
</body>
</html>