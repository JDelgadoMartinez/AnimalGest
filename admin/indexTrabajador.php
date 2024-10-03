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
if (isset($_REQUEST["enviar"])) {
    $nombreUsuario = $_POST["nombreUsuario"];
    $passUsuario = $_POST["passUsuario"];
    $emailUsuario = $_POST["emailUsuario"];
    $query = "UPDATE trabajadores SET
                usuario='$nombreUsuario', pass='$passUsuario', email='$emailUsuario' WHERE idTrabajador=" . $usuario;
    $conexiondb->execute_single_query($query);
?>
    <script type="text/javascript">
        alert("Datos del usuario actualizados correctamente");
        window.location = "indexTrabajador.php";
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
                        <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Información Usuario</h3>
                        <?php
                        $conexiondb->get_results_from_query("SELECT * FROM trabajadores WHERE idTrabajador='" . $usuario . "'");
                        $filas = $conexiondb->get_rows();
                        for ($i = 0; $i < count($filas); $i++) {
                            $fila = $filas[$i];
                        ?>
                            <form class="form-horizontal" action="indexTrabajador.php" method="post">
                                <div class="form-group" style="padding: 5px;">
                                    <label for="exampleInputUser">Usuario</label>
                                    <br>
                                    <input type="text" name="nombreUsuario" style="font-size: 18px; font-weight: bold;" value="<?= $fila['usuario'] ?>" required></b>
                                </div>
                                <div class="form-group" style="padding: 5px;">
                                    <label for="exampleInputPassword">Contraseña</label>
                                    <br>
                                    <b><input type="password" name="passUsuario" style="font-size: 18px; font-weight: bold" value="<?= $fila['pass'] ?>" required></b>
                                </div>
                                <div class="form-group" style="padding: 5px;">
                                    <label for="exampleInputEmail">Email</label>
                                    <br>
                                    <b><input type="text" name="emailUsuario" style="font-size: 18px; font-weight: bold" value="<?= $fila['email'] ?>" required></b>
                                </div>
                                <br>
                                <button class="btn btn-success" style="font-family: Comic Sans MS, menu; color: white" type="submit" name="enviar" value="Actualizar">Actualizar Datos Usuario</button>
                            </form>
                    <?php
                        }
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