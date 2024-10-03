<?php
session_start();
include_once '../ModeloBD.php';
$conexiondb = new ModeloBD("animalgest");
$usuario = $_SESSION["conectado"];
if (!isset($usuario)) {
    echo "<script>
            alert ('No estás conectado')
            window.location = '../login.php';
        </script>";
}
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>

<head>
    <title>Tu gestoría animal</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <style>
        .btn {
            margin-top: 50px;
            margin-bottom: 50px;
            margin-left: 10px;
        }

        .col2 {
            margin-left: 30%;
        }
    </style>
    <nav class="navbar navbar-light bg-light navbar-expand-lg">
        <img src="../img/AnimalGest.png" style="width:100px">
        <div class="topnav" id="navbarNav">
            <a class="nav-link" href="indexTrabajador.php">Inicio</a>
            <a class="nav-link" href="eventos.php">Eventos</a>
            <a class="nav-link" href="desconexion.php">[Desconectarse]</a>
        </div>
    </nav>
    <div class="album py-5 bg-light">
        <div class="about">
            <div class="container">
                <div class="about-padding-w3ls">
                    <?php
                    $sql = $conexiondb->get_results_from_query("SELECT * FROM trabajadores WHERE idTrabajador='" . $usuario . "'");
                    $filas = $conexiondb->get_rows();
                    for ($i = 0; $i < count($filas); $i++) {
                        $fila = $filas[$i];
                    ?>
                        <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Bienvenid@ <?php echo $fila["usuario"] ?></h3>
                    <?php
                    }
                    ?>
                    <div class="container" style="text-align:center">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            <div class="col1">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <a href="gestionAnimales.php"><button class="btn btn-danger" style="font-family: Comic Sans MS, menu; color: white" type="submit">Gestión Animales</button></a>
                                        <br>
                                        <br>
                                        <a href="animalesAdoptados.php"><button class="btn btn-primary" style="font-family: Comic Sans MS, menu; color: white" type="submit">ADOPTADOS</button></a>
                                        <a href="animalesAcogida.php"><button class="btn btn-info" style="font-family: Comic Sans MS, menu; color: white" type="submit">ACOGIDAS</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <a href="aniadirAnimales.php"><button class="btn btn-secondary" style="font-family: Comic Sans MS, menu; color: white" type="submit">Añadir Animales</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact" id="contact" style="text-align: center; margin-top: 5%">
        <div class="container">
            <div class="contact-padding">
                <div class="footer">
                    <p>© 2024 All Rights Reserved | Design by Jose Javier Delgado Martinez</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("navbarNav");
            if (x.className === "navbar") {
                x.className += " responsive";
            } else {
                x.className = "navbar";
            }
        }
    </script>
</body>

</html>