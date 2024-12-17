<?php 
include 'mySQLConnection.php';

$sql = "SELECT * 
        FROM reporte_ventas_y_empleados_por_sucursal;";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #0078D7;
            color: white;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #d9f1ff;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>Reporte de Ventas y Empleados por Sucursal</h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Código</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Código Postal</th>
                    <th>Número de Ventas</th>
                    <th>Total de Ventas</th>
                    <th>Empleados</th>
                </tr>
              </thead>
              <tbody>";

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . ($row["codigo_sucursal"] ?? '') . "</td>";
            echo "<td>" . ($row["ciudad_sucursal"] ?? '') . "</td>";
            echo "<td>" . ($row["direccion_sucursal"] ?? '') . "</td>";
            echo "<td>" . ($row["codigo_postal"] ?? '') . "</td>";
            echo "<td>" . ($row["numero_ventas"] ?? '') . "</td>";
            echo "<td>$" . number_format($row["total_ventas"] ?? 0, 2) . "</td>";
            echo "<td>" . ($row["empleados"] ?? '') . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No hay resultados disponibles.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
