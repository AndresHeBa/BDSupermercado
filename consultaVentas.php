<?php 
include 'mySQLConnection.php';
include 'header.php';

$sql = "SELECT CodigoSucursal, NombreVendedor, SUM(TotalVenta) AS ventas_vendedor 
        FROM venta GROUP BY CodigoSucursal, NombreVendedor WITH ROLLUP;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<thead><tr><th>Sucursal</th><th>Nombre del Vendedor</th><th>Ventas</th></tr></thead><tbody>";

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row["CodigoSucursal"] ?? '') . "</td>";
        if (!$row["CodigoSucursal"] && !$row["NombreVendedor"]) {
            echo "<td>" . ($row["NombreVendedor"] ?? 'Total General') . "</td>";
        }else{
            echo "<td>" . ($row["NombreVendedor"] ?? 'Total Sucursal') . "</td>";
        }
        echo "<td>" . ($row["ventas_vendedor"]) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No hay resultados.</p>";
}

$conn->close();
?>
<html>
    <link rel="stylesheet" href="est/consul.css">
</html>