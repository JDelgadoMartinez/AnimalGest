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
    <nav class="navbar navbar-light bg-light navbar-expand-lg">
        <img src="../img/AnimalGest.png" style="width:100px">
        <div class="topnav" id="navbarNav">
            <a class="nav-link" href="#">Inicio</a>
            <a class="nav-link" href="animalesAdmin.php">Gestión Animales</a>
            <a class="nav-link" href="eventos.php">Eventos</a>
            <a class="nav-link" href="desconexion.php">[Desconectarse]</a>
        </div>
    </nav>
    <div class="album py-5 bg-light">
        <div class="about">
            <div class="container">
                <div class="about-padding-w3ls">
                    <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Introducir Datos del Animal</h3>
                    <?php
                    if (isset($_REQUEST["enviar"])) {
                        //subir foto
                        $imagen = (isset($_FILES['imagen']['tmp_name'])) ? $_FILES['imagen']['tmp_name'] : null;
                        if ($imagen) {
                            $temporal = $_FILES['imagen']['tmp_name'];
                            $ruta_imagen = 'archivo/' . $_FILES['imagen']['name'];
                            move_uploaded_file($temporal, $ruta_imagen);
                            $query = "INSERT INTO `animales` (idTrabajador, `nombreAnimal`, `edad`, `descripcion`, `peso`, `raza`, `imagen`, adopcion, acogida) "
                                . "VALUES ('" . $usuario . "','" . $_REQUEST["nombreAnimal"] . "','" . $_REQUEST["edad"] . "','" . $_REQUEST["descripcion"] . "','" . $_REQUEST["peso"] . "','" . $_REQUEST["raza"] . "','" . $ruta_imagen . "','" . '0' . "','" . '0' . "')";
                            $conexiondb->execute_single_query($query);
                        }
                    ?>
                        <!-- <script type="text/javascript">
                            alert("Datos del animal añadidos correctamente");
                            window.location = "aniadirAnimales.php";
                        </script>-->
                    <?php
                    } else {
                    ?>
                        <form class="form-horizontal" action="aniadirAnimales.php" method="post" enctype="multipart/form-data">
                            <div class="form-group" style="padding: 5px;">
                                <label style="font-family: Comic Sans MS, menu; font-size: 15px;">Nombre Animal</label>
                                <input type="text" class="form-control" style="width:25%" name="nombreAnimal" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label style="font-family: Comic Sans MS, menu; font-size: 15px;">Descripción</label>
                                <textarea class="form-control" style="width:40%" rows="3" name="descripcion" required></textarea>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label style="font-family: Comic Sans MS, menu; font-size: 15px;">Edad</label>
                                <input type="text" class="form-control" style="width:25%" name="edad" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label style="font-family: Comic Sans MS, menu; font-size: 15px;">Peso</label>
                                <input type="text" class="form-control" style="width:25%" name="peso" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label style="font-family: Comic Sans MS, menu; font-size: 15px;">Raza</label>
                                <input type="text" class="form-control" style="width:25%" name="raza" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label style="font-family: Comic Sans MS, menu; font-size: 15px;">Foto Archivo Animal: </label>
                                <input type="file" name="imagen" required>
                            </div>
                            <button class="btn btn-primary" style="font-family: Comic Sans MS, menu; color: white" type="submit" name="enviar" value="Registro">Añadir Animal</button>
                            <div class="clearfix"></div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
                <div class="clearfix"> </div>
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