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
            <a class="nav-link" href="registroTrabajador.php">Registro Trabajador</a>
        </div>
    </nav>
    <div class="album py-5 bg-light">
        <div class="about">
            <div class="container">
                <div class="about-padding-w3ls">
                    <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Conectarse</h3>
                    <?php
                    if (isset($_REQUEST["enviar"])) {
                        $nombreUsuarioTrabajador = $_POST["usuario"];
                        $passUsuarioTrabajador = $_POST["pass"];
                        $codigoAcceso = $_POST["codigoAcceso"];
                        $conexiondb->get_results_from_query("SELECT * FROM trabajadores WHERE usuario='$nombreUsuarioTrabajador' AND pass='$passUsuarioTrabajador' AND codigo='$codigoAcceso'");
                        $resultado = $conexiondb->get_rows()[0];
                        if (isset($resultado)) {
                            $_SESSION["conectado"] = $resultado["idTrabajador"];
                            header("Location: admin/indexTrabajador.php");
                        } else {
                            echo '
                                <script>   
                                document.getElementById("error").value="El usuario, contraseña, Email o Código introducinos no es correcto";
                                </script>';
                            header("Location: login.php");
                        }
                    } else {
                    ?>
                        <form class="form-horizontal" action="login.php" method="post">
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputUser">Nombre Usuario</label>
                                <input type="text" class="form-control" id="exampleInputUser" name="usuario" placeholder="Introduce tu nombre de usuario" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputPassword">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword" name="pass" placeholder="Password" required>
                                <a id="recuperacion" href="recuperacionPass.php">¿Has olvidado la contraseña?</a>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputCode">Código de acceso</label>
                                <input type="password" class="form-control" id="exampleInputCode" name="codigoAcceso" placeholder="Introduce el código de acceso">
                            </div>
                            <br>
                            <button class="btn btn-success" style="font-family: Comic Sans MS, menu; color: white" type="submit" name="enviar" value="Login">Enviar</button>
                            <div class="clearfix"></div>
                            <p id="error" style="color: red; font-family: Comic Sans MS, menu; font-size: 20px;"></p>
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