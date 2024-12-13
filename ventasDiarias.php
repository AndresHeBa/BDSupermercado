<?php 
include 'mySQLConnection.php';

$sql = "SELECT NombreVendedor, TotalVenta, CodigoSucursal, Fecha, totalDia(Fecha) as TotalDia
        FROM venta ORDER BY Fecha, CodigoSucursal;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<thead><tr><th>Vendedor</th><th>Total de la Venta</th><th>Sucursal</th><th>Fecha</th><th>Total del Dia</th></tr></thead><tbody>";

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row["NombreVendedor"] ?? '') . "</td>";
        echo "<td>" . ($row["TotalVenta"] ?? '') . "</td>";
        echo "<td>" . ($row["CodigoSucursal"] ?? '') . "</td>";
        echo "<td>" . ($row["Fecha"] ?? '') . "</td>";
        echo "<td>" . ($row["TotalDia"] ?? '') . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No hay resultados.</p>";
}

$conn->close();
?>
