<?php
include 'mySQLConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombreVendedor = $_POST['nombreVendedor'];
    $totalVenta = $_POST['totalVenta'];
    $codigoSucursal = $_POST['codigoSucursal'];
    $fecha = $_POST['fecha'];

    // Escapar los valores para evitar inyecciones SQL
    $nombreVendedor = $conn->real_escape_string($nombreVendedor);
    $totalVenta = $conn->real_escape_string($totalVenta);
    $codigoSucursal = empty($codigoSucursal) ? "NULL" : $conn->real_escape_string($codigoSucursal);
    $fecha = $conn->real_escape_string($fecha);

    // Construir la consulta SQL
    $sql = "UPDATE venta SET 
                NombreVendedor = '$nombreVendedor',
                TotalVenta = $totalVenta,
                CodigoSucursal = $codigoSucursal,
                Fecha = '$fecha'
            WHERE CodigoVenta = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Venta actualizada correctamente.";
    } else {
        echo "Error al actualizar la venta: " . $conn->error;
    }

    $conn->close();
}
?>
