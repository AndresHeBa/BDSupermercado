<?php
include 'mySQLConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $codigoGerente = $_POST['codigoGerente'];
    $codigoProveedor = $_POST['codigoProveedor'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $cp = $_POST['cp'];

    // Escapar los valores para evitar inyecciones SQL
    $codigoGerente = empty($codigoGerente) ? "NULL" : $conn->real_escape_string($codigoGerente);
    $codigoProveedor = empty($codigoProveedor) ? "NULL" : $conn->real_escape_string($codigoProveedor);
    $ciudad = $conn->real_escape_string($ciudad);
    $direccion = $conn->real_escape_string($direccion);
    $cp = $conn->real_escape_string($cp);

    // Construir la consulta SQL
    $sql = "UPDATE sucursal SET 
                CodigoGerente = $codigoGerente, 
                CodigoProveedor = $codigoProveedor, 
                Ciudad = '$ciudad', 
                Direccion = '$direccion', 
                CP = '$cp' 
            WHERE CodigoSucursal = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Sucursal actualizada correctamente.";
    } else {
        echo "Error al actualizar la sucursal: " . $conn->error;
    }

    $conn->close();
}
?>
