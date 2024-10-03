<?php
session_start();
include_once 'ModeloBD.php';
$conexiondb = new ModeloBD("animalgest");

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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light navbar-expand-lg">
        <img src="img/AnimalGest.png" style="width:100px">
        <div class="topnav" id="navbarNav">
            <a class="nav-link" href="index.php">Inicio</a>
            <a class="nav-link" href="verAnimales.php">Nuestros Animales</a>
            <a class="nav-link" href="login.php">Conectarse</a>
        </div>
    </nav>
    <div class="album py-5 bg-light">
        <div class="about">
            <div class="container">
                <div class="about-padding-w3ls">
                    <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Conectarse</h3>
                    <?php
                    if (isset($_REQUEST["enviar"])) {
                        $emailUsuario = $_POST["email"];
                        $conexiondb->get_results_from_query("SELECT idTrabajador FROM trabajadores WHERE email='$emailUsuario'");
                        $resultado = $conexiondb->get_rows()[0];
                        if (isset($resultado)) {
                            $_SESSION["conectado"] = $resultado["idTrabajador"];
                            header("Location: actualizarPass.php");
                        } else {
                    ?>
                            <script type="text/javascript">
                                alert("El correo introducido no existe. Inténtalo de nuevo");
                                window.location = "recuperacionPass.php";
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <form class="form-horizontal" action="recuperacionPass.php" method="post">
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputUser">Email Usuario</label>
                                <input type="text" class="form-control" id="exampleInputUser" name="email" placeholder="Introduce tu email de usuario" required>
                            </div>
                            <br>
                            <button class="btn btn-success" style="font-family: Comic Sans MS, menu; color: white" type="submit" name="enviar" value="Recuperar">Confirmar Email</button>
                            <p id="error" style="font-family: Comic Sans MS, menu; font-size: 20px;"></p>
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