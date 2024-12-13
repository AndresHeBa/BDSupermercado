<?php 
include 'mySQLConnection.php';

$sql = "CALL cambioGerente(" . $_POST["vjoGerente"] . ", " . $_POST["nvoGerente"] . ")";
$result = $conn->query($sql);

header('Location: consultaEmpleados.php');
die();

$conn->close();
?>