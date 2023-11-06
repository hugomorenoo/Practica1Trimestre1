<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Registro</title>
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

        h2 {
            color: #333;
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

        #volver{
            margin-top: 0.75em;
        }

        #volver a{
            color: purple;
            font-size: 0.80em;
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
        <h2>Sign Up</h2>
        <form action="Procesar_registro.php" method="post">
            <input type="text" name="nuevoUsuario" placeholder="Nombre de usuario" required>
            <input type="password" name="nuevaContraseña" placeholder="Nueva contraseña" required>
            <input type="password" name="contraseñaRep" placeholder="Repite Contraseña" required>
            <input type="submit" value="Registrarse">
        </form>
        <div id="volver">
            <a href="Login.php"> Volver al login </a>
        </div>
    </div>
</body>
</html>