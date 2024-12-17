<?php 
include 'mySQLConnection.php';
include 'header.php';

$sql = "SELECT * FROM ventas_por_articulo_y_unidades_vendidas;";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas por Artículo</title>
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
            background-color: #6b8e6b;
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
    <h1>Reporte de Ventas por Artículo y Unidades Vendidas</h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Código Artículo</th>
                    <th>Nombre Artículo</th>
                    <th>Ventas Por Artículo</th>
                    <th>Unidades Vendidas</th>
                    <th>Fechas de Ventas</th>
                </tr>
              </thead>
              <tbody>";

        // Mostrar los datos de cada fila
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . ($row["CodigoArticulo"] ?? '') . "</td>";
            echo "<td>" . ($row["NombreArticulo"] ?? '') . "</td>";
            echo "<td>" . ($row["VentasPorArticulo"] ?? 0) . "</td>";
            echo "<td>" . ($row["UnidadesVendidas"] ?? 0) . "</td>";
            echo "<td>" . ($row["FechasDeVentas"] ?? 'N/A') . "</td>";
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
