<?php 
include 'mySQLConnection.php';
include 'header.php';

$sql = "SELECT * FROM empleado;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<thead><tr><th>Codigo</th><th>Nombre</th><th>Telefono</th><th>Puesto</th><th>Sueldo</th><th>RFC</th><th>Codigo Gerent</th><th>Codigo Sucursal</th></tr></thead><tbody>";

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . ($row["CodigoEmpleado"] ?? '') . "</td>";
        echo "<td>" . ($row["Nombre"] ?? '') . "</td>";
        echo "<td>" . ($row["Telefono"]) . "</td>";
        echo "<td>" . ($row["Puesto"]) . "</td>";
        echo "<td>" . ($row["Sueldo"]) . "</td>";
        echo "<td>" . ($row["RFC"]) . "</td>";
        echo "<td>" . ($row["CodigoGerente"]) . "</td>";
        echo "<td>" . ($row["CodigoSucursal"]) . "</td>";
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
    <body>
    <form action="cambiarGerente.php" method="POST" id="cambiarGerenteForm">
    <label for="vjoGerente">Viejo Gerente:</label><br>
    <input type="text" id="vjoGerente" name="vjoGerente"><br>
    
    <label for="nvoGerente">Nuevo Gerente:</label><br>
    <input type="text" id="nvoGerente" name="nvoGerente"><br><br>
    
    <input type="submit" value="Cambiar Gerente">
</form> 
    </body>
</html>
