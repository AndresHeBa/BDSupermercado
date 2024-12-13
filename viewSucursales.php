<?php 
include 'mySQLConnection.php';

$sql = "SELECT * 
        FROM reporte_ventas_y_empleados_por_sucursal;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<thead><tr><th>Codigo</th><th>Ciudad</th><th>Direccion</th><th>Codigo Postal</th>
    <th>Numero de Ventas</th><th>Total de Ventas</th><th>Empleados</th></tr></thead><tbody>";

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row["codigo_sucursal"] ?? '') . "</td>";
        echo "<td>" . ($row["ciudad_sucursal"] ?? '') . "</td>";
        echo "<td>" . ($row["direccion_sucursal"] ?? '') . "</td>";
        echo "<td>" . ($row["codigo_postal"] ?? '') . "</td>";
        echo "<td>" . ($row["numero_ventas"] ?? '') . "</td>";
        echo "<td>" . ($row["total_ventas"] ?? '') . "</td>";
        echo "<td>" . ($row["empleados"] ?? '') . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No hay resultados.</p>";
}

$conn->close();
?>
