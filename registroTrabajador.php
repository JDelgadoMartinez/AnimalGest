<?php
session_start();
include_once 'ModeloBD.php';
$conexiondb = new ModeloBD("animalgest");
/*if (isset($_REQUEST["enviar"])) {
    $alpha = "123qwertyuiopa456sdfghjklzxcvbnm789";
    $code = "";
    $longitud = 10;
    for ($i = 0; $i < $longitud; $i++) {
        $code .= $alpha[rand(0, strlen($alpha) - 1)];
    }
    
    $texto_mail = "Para activar tu cuenta pulsa en el siguiente enlace: localhost:3000/activacion.php?codigo=$code";
    $destinatario = $_REQUEST["email"];
    $asunto = "Activación de cuenta en AnimalGest";
    $headers =  'MIME-Version: 1.0' . "\r\n"; 
    $headers .= 'From: AnimalGest <animalgest@animalgest.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
    $exito = mail($destinatario, $asunto, $texto_mail, $headers);
    if ($exito) {
        echo "Se ha enviado un mensaje a tu correo electronico para verificar la cuenta";
    } else {
        echo "Ha ocurrido un error durante el envío de confirmación del correo";
    }
} else {
*/
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
                    <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Registro Trabajador</h3>
                    <?php
                    if (isset($_REQUEST["enviar"])) {
                        $query = "INSERT INTO `trabajadores`(`usuario`, `pass`, `nombre`, `apellido`, `email`, `codigo`)"
                            . "VALUES ('" . $_REQUEST["nombreUsuario"] . "','" . $_REQUEST["pass"] . "','" . $_REQUEST["nombre"] . "','" . $_REQUEST["apellido"] . "','" . $_REQUEST["email"] . "','" . 'qwerty' . "')";
                        $conexiondb->execute_single_query($query);
                        echo "<script> alert('Usuario creado correctamente')</script>";
                        header("Location: login.php");
                    } else {
                    ?>
                        <form class="form-horizontal" action="registroTrabajador.php" method="post">
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputUser">Nombre Usuario</label>
                                <input type="text" class="form-control" id="exampleInputUser" name="nombreUsuario" placeholder="Introduce tu nombre de usuario" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputPassword">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword" name="pass" placeholder="Password" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputUserName">Nombre</label>
                                <input type="text" class="form-control" id="exampleInputUserName" name="nombre" placeholder="Introduce tu nombre" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputUserAp">Apellido</label>
                                <input type="text" class="form-control" id="exampleInputUserAp" name="apellido" placeholder="Introduce tu nombre" required>
                            </div>
                            <div class="form-group" style="padding: 5px;">
                                <label for="exampleInputEmail">Correo</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Introduce tu correo" required>
                            </div>
                            <button class="btn btn-primary" style="font-family: Comic Sans MS, menu; color: white" type="submit" name="enviar" value="Registro">Enviar</button>
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