<?php 
include 'mySQLConnection.php';

$sql = "SELECT * 
        FROM reporte_provedores_y_articulos_por_sucursal;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<thead><tr><th>Codigo Proveedor</th><th>Telefono</th><th>Nombre Proveedor</th><th>Codigo Sucursal</th>
    <th>Tipo de Articulo</th><th>Ciudad</th><th>Direccion</th><th>Codigo Articulo</th>
    <th>Nombre Articulo</th><th>Precio Compra</th><th>Precio Venta</th><th>Total Articulos</th></tr></thead><tbody>";

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row["codigoProveedor"] ?? '') . "</td>";
        echo "<td>" . ($row["telefono"] ?? '') . "</td>";
        echo "<td>" . ($row["nombre_proveedor"] ?? '') . "</td>";
        echo "<td>" . ($row["codigoSucursal"] ?? '') . "</td>";
        echo "<td>" . ($row["tipoArticulo"] ?? '') . "</td>";
        echo "<td>" . ($row["ciudad"] ?? '') . "</td>";
        echo "<td>" . ($row["direccion"] ?? '') . "</td>";
        echo "<td>" . ($row["codigoArticulo"] ?? '') . "</td>";
        echo "<td>" . ($row["nombre_articulo"] ?? '') . "</td>";
        echo "<td>" . ($row["precioCompra"] ?? '') . "</td>";
        echo "<td>" . ($row["precioVenta"] ?? '') . "</td>";
        echo "<td>" . ($row["total_articulos"] ?? '') . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No hay resultados.</p>";
}

$conn->close();
?>
