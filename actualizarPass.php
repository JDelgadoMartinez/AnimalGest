<?php
session_start();
include_once 'ModeloBD.php';
$conexiondb = new ModeloBD("animalgest");
$usuario = $_SESSION["conectado"];
if (isset($_REQUEST["recuperar"])) {
    $passUsuario = $_POST["pass"];
    $query = "UPDATE trabajadores SET
                pass='$passUsuario' WHERE idTrabajador=" . $usuario;
    $conexiondb->execute_single_query($query);
?>
    <script type="text/javascript">
        alert("Has cambiado correctamente tu contraseña");
        window.location = "login.php";
    </script>
<?php
} else {
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
            <img src="../img/AnimalGest.png" style="width:100px">
            <div class="topnav" id="navbarNav">
                <a class="nav-link" href="../index.php">Inicio</a>
                <a class="nav-link" href="../verAnimales.php">Nuestros Animales</a>
            </div>
        </nav>
        <div class="album py-5 bg-light">
            <div class="about">
                <div class="container">
                    <div class="about-padding-w3ls">
                        <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Información Usuario</h3>
                        <form class="form-horizontal" action="actualizarPass.php" method="post">
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputUser">Nueva Contraseña</label>
                                <br>
                                <b><input type="password" name="pass" style="font-size: 18px;" required></input></b>
                            </div>
                            <br>
                            <button class="btn btn-warning" style="font-family: Comic Sans MS, menu; color: white" type="submit" name="recuperar" value="Actualizar">Actualizar Datos Usuario</button>
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