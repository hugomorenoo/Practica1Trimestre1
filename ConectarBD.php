<?php
    require_once 'ConfigBD.php';
    class ConectarBD {

        private $hostname = HOST;
        private $database = BD;
        private $user = USER;
        private $password = PASSWORD;
        private $charset = CHARSET;
        private $conexion;

        function getConexion() {
            try {
                $this->conexion = new PDO('mysql:host='.$this->hostname.';dbname='.$this->database . ';charset='.$this->charset,$this->user, $this->password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $err) {
                echo "¡ERROR: !".$err->getMessage();
                die();
            }
            return $this->conexion;
        }

        function cerrarConexion() {
            $this->conexion = null;
        }
    }
?>