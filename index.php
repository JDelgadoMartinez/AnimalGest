<?php
session_start();
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
            <a class="nav-link" href="#">Inicio</a>
            <a class="nav-link" href="verAnimales.php">Nuestros Animales</a>
            <a class="nav-link" href="registroTrabajador.php">Registro Trabajadores</a>
            <a class="nav-link" href="login.php">Conectarse</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
        </div>
    </nav>
    <div class="album py-5 bg-light">
        <h1 class="wp-block-heading has-text-align-center has-x-large-font-size" style="text-align:center">ANIMALGEST</h1>
        <div style="height:1.25rem" aria-hidden="true" class="wp-block-spacer" style="text-align:center"></div>
        <p class="has-text-align-center" style="text-align:center">Porque la gestión de nuestro albergue es también importante</p>
        <img src="img/paisaje.avif" alt="Campo" style="border-radius: 10px; margin-left:35%; margin-bottom: 5%">
        <div class="container" style="text-align:center">
            <h2 class="has-text-align-center is-style-asterisk">Pasión por los animales</h2>
            <p class="has-text-align-center">Nuestros albergues están listos para acoger a nuestros animales.</p>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Renovación y restauración</h3>
                            <p class="card-text">El albergue que disponemos está en constante evolución, para darles una mejor calidad de vida a nuestros peluditos</p>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Nuestros animales</h3>
                            <p class="card-text">Tenemos control de todos los animales que entren en nuestro albergue.</p>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Acceso a la app</h3>
                            <p class="card-text">Mediante esta web, podrás gestionar de manera sencilla el albergue, realizando funciones que te ahorrarán tiempo.</p>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
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