<?php
session_start();
include_once '../ModeloBD.php';
$conexiondb = new ModeloBD("animalgest");
$usuario = $_SESSION["conectado"];
$idAnimal = $_REQUEST["idAnimal"];
if (!isset($usuario)) {
    echo "<script>
            alert ('No estás conectado')
            window.location = '../login.php';
        </script>";
}

$query = "UPDATE animales SET acogida='1' WHERE idAnimal='".$idAnimal."'";
$conexiondb->execute_single_query($query);
echo $query;
echo "<script>
    alert ('El animal ha sido ADOPTADO!!');
    window.location = 'gestionAnimales.php';
</script>";
?>