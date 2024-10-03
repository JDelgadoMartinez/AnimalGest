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
            <a class="nav-link" href="desconexion.php">[Desconectarse]</a>
        </div>
    </nav>
    <div class="album py-5 bg-light">
        <div class="about">
            <div class="container">
                <div class="about-padding-w3ls">
                    <h3 class="wp-block-heading has-text-align-left is-style-asterisk has-body-font-family has-medium-font-size" style="font-style:normal;font-weight:600">Nuestros Animales</h3>
                    <?php
                    $conexiondb->get_results_from_query("SELECT * FROM animales WHERE adopcion='0' AND acogida='0'");
                    $animales = $conexiondb->get_rows();
                    if ($animales == 0) {
                        echo "<script>
                                alert ('No hay animales que mostrar');
                                window.location = 'animalesAdmin.php';
                                </script>";
                    }
                    for ($i = 0; $i < count($animales); $i++) {
                        $animal = $animales[$i];
                    ?>
                        <div style=" float: left; background-color: #E8F6F3; width: 30%; height: 100%; word-wrap: break-word; margin-left: 20px; margin-bottom: 20px; padding: 10px; box-shadow: 2px 2px 2px 2px; border-radius: 10px; margin-top: 15px;">
                            <div class="col-md-12 about-img">
                                <img src="<?= $animal['imagen']; ?>" style="width: 100%; height: 150px;">
                            </div>
                            <div class="col-md-12 about-text">
                                <h4 style="color: #2874A6;"><?= $animal["nombreAnimal"]; ?></h4>
                            </div>
                            <div class="about-text-padding-agile">
                                <p style="color: black; width: 100%; text-align: left; font: oblique 120% cursive;"><?= $animal["descripcion"]; ?></p>
                            </div>
                            <div class="about-text-padding-agile">
                                <label for="exampleAge">Edad</label>
                                <p style="color: black; width: 100px; text-align: left; font: oblique 120% cursive; "><?= $animal["edad"]; ?></p>
                            </div>
                            <div class="about-text-padding-agile">
                                <label for="exampleAge">Peso:</label>
                                <p style="color: black; width: 100px; text-align: left; font: oblique 120% cursive; "><?= $animal["peso"]; ?></p>
                            </div>
                            <div class="about-text-padding-agile">
                                <label for="exampleAge">Raza</label>
                                <p style="color: black; width: 150px; text-align: left; font: oblique 120% cursive; "> <?= $animal["raza"]; ?></p>
                            </div>
                            <a href="animalesAdopcion.php?idAnimal=<?= $animal["idAnimal"]; ?>"><input style="margin-right: 10px;" class="btn btn-success" type="submit" name="adopcion" value="Adoptado"></a>
                            <a href="animalesAcogidos.php?idAnimal=<?= $animal["idAnimal"]; ?>"><input style="margin-left: 10px;" class="btn btn-warning" type="submit" name="acogida" value="Acogida"></a>
                        </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="clearfix"></div>
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